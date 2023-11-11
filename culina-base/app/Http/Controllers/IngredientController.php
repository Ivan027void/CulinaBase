<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function ingredientUser($id)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            $recipe = Recipe::findOrFail($id);
            $ingredient = Ingredient::where('recipe_id', $id)->get();

            return view('ingredientUser', compact('recipe', 'ingredient'));
        }
    }

    public function storeIngredient(Request $request, $recipe_id)
{
    // Validate the input data
    $request->validate([
        'ingredients.*' => 'required',
    ]);

    // Retrieve the input data for ingredients, quantity, size, and note
    $ingredients = $request->input('ingredients');
    $quantities = $request->input('quantity');
    $sizes = $request->input('size');
    $notes = $request->input('note');

    // Loop through the submitted ingredients and insert them into the database
    foreach ($ingredients as $key => $ingredientName) {
        $ingredient = new Ingredient([
            'ingredient_name' => $ingredientName,
            'recipe_id' => $recipe_id,
            'quantity' => $quantities[$key] ?? null, // Set to null if not provided
            'size' => $sizes[$key] ?? null, // Set to null if not provided
            'note' => $notes[$key] ?? null, // Set to null if not provided
        ]);
        $ingredient->save();
    }

    // Redirect back or to a specific page after insertion
    return redirect()->back()->with('success', 'Ingredients added successfully');
}
    public function updateIngredient(Request $request, $recipe_id, $ingredientId)
    {
        // Validate the request data
        $request->validate([
            'ingredient_name' => 'required|string',
            'quantity' => 'nullable|string',
            'size' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        // Find the ingredient by ID
        $ingredient = Ingredient::findOrFail($ingredientId);

        // Update the ingredient
        $ingredient->update([
            'ingredient_name' => $request->input('ingredient_name'),
            'quantity' => $request->input('quantity'),
            'size' => $request->input('size'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('ingredient-user', $recipe_id)->with('success', 'Ingredient updated successfully');
    }


    public function deleteIngredient($recipe_id, $ingredientId)
    {
        $ingredient = Ingredient::find($ingredientId);

        if (!$ingredient) {
            return redirect()->route('ingredient-user', $recipe_id)->with('error', 'Ingredient not found');
        }

        $ingredient->delete();

        return redirect()->route('ingredient-user', $recipe_id)->with('success', 'Ingredient deleted successfully');
    }
}
