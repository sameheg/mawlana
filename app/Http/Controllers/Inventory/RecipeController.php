<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        return Recipe::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'component_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'numeric'],
            'unit_id' => ['required', 'exists:units,id'],
        ]);

        return Recipe::create($data);
    }

    public function show(Recipe $recipe)
    {
        return $recipe;
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'product_id' => ['sometimes', 'exists:products,id'],
            'component_id' => ['sometimes', 'exists:products,id'],
            'quantity' => ['sometimes', 'numeric'],
            'unit_id' => ['sometimes', 'exists:units,id'],
        ]);

        $recipe->update($data);

        return $recipe;
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->noContent();
    }
}

