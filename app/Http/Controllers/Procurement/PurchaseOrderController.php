<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return PurchaseOrder::with('supplier')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'status' => ['required', 'string'],
            'total' => ['required', 'numeric'],
        ]);

        $order = PurchaseOrder::create($data);

        return response()->json($order, 201);
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        return $purchaseOrder->load('supplier');
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $data = $request->validate([
            'status' => ['sometimes', 'string'],
            'total' => ['sometimes', 'numeric'],
        ]);

        $purchaseOrder->update($data);

        return $purchaseOrder;
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return response()->noContent();
    }
}
