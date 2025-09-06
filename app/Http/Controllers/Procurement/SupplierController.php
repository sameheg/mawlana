<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'contact_info' => ['nullable', 'string'],
        ]);

        $supplier = Supplier::create($data);

        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string'],
            'contact_info' => ['sometimes', 'string'],
        ]);

        $supplier->update($data);

        return $supplier;
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->noContent();
    }
}
