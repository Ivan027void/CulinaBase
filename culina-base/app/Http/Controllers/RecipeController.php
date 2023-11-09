<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // Retrieve the reviews for the recipe
        $reviews = Review::where('recipe_id', $id)->get();

       // Retrieve the author (user) information
        $author = User::find($recipe->author_id);

     return view('recipe_info', compact('recipe', 'steps', 'ingredients', 'reviews', 'author'));
    }


    public function index()
    {
        $recipes = Recipe::all(); // Retrieve all recipes from the database
        return view('landingpage', compact('recipes'));
    }

    public function fullIndex()
    {
        $recipes = Recipe::all(); // Retrieve all recipes from the database
        return view('option', compact('recipes'));
    }

    public function searchRecipes(Request $request)
{
    $searchText = $request->input('search'); // Retrieve the search input from the request
    $recipes = Recipe::where('recipe_name', 'like', '%' . $searchText . '%')->get();

    return view('recipe.index', ['recipes' => $recipes]);
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
        return view('editAdmin', compact('recipe', 'steps', 'ingredients'));
    }

public function delete($id)
{
    $recipe = Recipe::findOrFail($id);
    $this->authorize('delete', $recipe); // Check authorization
    $recipe->delete();
    return redirect()->view('adminPage')->with('success', 'Recipe deleted successfully');
}

public function showAdmin($id)
{
    // You should add validation and authorization checks here to ensure only admins can perform this action
    $recipe = Recipe::findOrFail($id);
    $steps = Step::where('recipe_id', $id)->get();
    $ingredients = Ingredient::whereHas('recipe', function ($query) use ($id) {
        $query->where('recipes.recipe_id', $id); // Use table alias
    })->get();
     // Retrieve the reviews for the recipe
     $reviews = Review::where('recipe_id', $id)->get();

        // Retrieve the author (user) information
        $author = User::find($recipe->author_id);

        return view('recipe_info', compact('recipe', 'steps', 'ingredients', 'reviews', 'author'));
        }

public function postReview(Request $request)
    {
        // Validate the input data
        $request->validate([
            'isi_review' => 'required|string|max:500',
        ]);

        // Ensure that the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to post a review');
        }

        // Create a new review instance
        $review = new Review();
        $review->recipe_id = $request->input('recipe_id');
        $review->review_content = $request->input('isi_review');
        $review->user_id = Auth::user()->id; // Set user_id from the authenticated user
        $review->reviewer_name = Auth::user()->name; // Set reviewer_name from the authenticated user

        // Save the review to the database
        $review->save();

        // Redirect back to the recipe page
        return redirect()->back()->with('success', 'Review posted successfully');
    }

}

