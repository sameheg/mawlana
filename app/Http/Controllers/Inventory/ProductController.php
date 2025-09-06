<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'stock' => ['required', 'numeric'],
            'min_stock' => ['required', 'numeric'],
            'unit_id' => ['nullable', 'exists:units,id'],
        ]);

        $product = Product::create($data);
        $this->notifyIfLow($product);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string'],
            'stock' => ['sometimes', 'numeric'],
            'min_stock' => ['sometimes', 'numeric'],
            'unit_id' => ['sometimes', 'exists:units,id'],
        ]);

        $product->update($data);
        $this->notifyIfLow($product);

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }

    protected function notifyIfLow(Product $product): void
    {
        if ($product->stock <= $product->min_stock) {
            $recipients = User::all();
            Notification::send($recipients, new LowStockNotification($product));
        }
    }
}

