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
        return view('admin', compact('recipes'));
    }

}

