<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\StockTransfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        return StockTransfer::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'from_branch' => ['required', 'string'],
            'to_branch' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
        ]);

        $transfer = StockTransfer::create($data + ['status' => 'pending']);

        return response()->json($transfer, 201);
    }

    public function approve(StockTransfer $stockTransfer)
    {
        $stockTransfer->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return $stockTransfer;
    }

    public function deliver(Request $request, StockTransfer $stockTransfer)
    {
        $data = $request->validate([
            'delivery_log' => ['nullable', 'string'],
        ]);

        $stockTransfer->update([
            'status' => 'delivered',
            'delivered_at' => now(),
            'delivery_log' => $data['delivery_log'] ?? $stockTransfer->delivery_log,
        ]);

        return $stockTransfer;
    }
}
