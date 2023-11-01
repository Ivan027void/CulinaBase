<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use app\Models\Step;
use app\Models\RecipeIngredient;
use app\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function show($id)
{
    $recipe = Recipe::with(['steps', 'ingredients'])->findOrFail($id);

    return view('recipe_info', compact('recipe'));
}


public function index()
{
    $recipes = Recipe::all(); // Retrieve all recipes from the database
    return view('landingpage', compact('recipes'));
}

}

