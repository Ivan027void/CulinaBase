<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function show($id)
    {
        // Retrieve the recipe
        $recipe = Recipe::findOrFail($id);

        // Retrieve the steps for the recipe
        $steps = Step::where('recipe_id', $id)->get();

        // Retrieve the ingredients for the recipe
        $ingredients = Ingredient::whereHas('recipe', function ($query) use ($id) {
            $query->where('recipes.recipe_id', $id); // Use table alias
        })->get();

        return view('recipe_info', compact('recipe', 'steps', 'ingredients'));
    }


    public function index()
    {
        $recipes = Recipe::all(); // Retrieve all recipes from the database
        return view('landingpage', compact('recipes'));
    }

    public function indexAdmin()
    {
        $recipes = Recipe::all(); // Retrieve all recipes from the database
        return view('adminPage', compact('recipes'));
    }
    public function edit($id)
{
    $recipe = Recipe::findOrFail($id);
    $this->authorize('edit', $recipe); // Check authorization
    $steps = Step::where('recipe_id', $id)->get();
    $ingredients = Ingredient::whereHas('recipe', function ($query) use ($id) {
        $query->where('recipes.recipe_id', $id);
    })->get();
    return view('edit_recipe', compact('recipe', 'steps', 'ingredients'));
}

public function delete($id)
{
    $recipe = Recipe::findOrFail($id);
    $this->authorize('delete', $recipe); // Check authorization
    $recipe->delete();
    return redirect()->route('adminPage')->with('success', 'Recipe deleted successfully');
}

public function showAdmin($id)
{
    // You should add validation and authorization checks here to ensure only admins can perform this action
    $recipe = Recipe::findOrFail($id);
    $steps = Step::where('recipe_id', $id)->get();
    $ingredients = Ingredient::whereHas('recipe', function ($query) use ($id) {
        $query->where('recipes.recipe_id', $id); // Use table alias
    })->get();

    return view('recipe_info', compact('recipe', 'steps', 'ingredients'));
}



}

