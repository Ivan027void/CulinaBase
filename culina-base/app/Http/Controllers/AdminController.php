<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
        // Use the correct route name 'admin.page' for redirection
        return redirect()->route('admin.page')->with('success', 'Recipe deleted successfully');
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

    public function formAdmin()
    {
        return view('formAdmin');
    }

    public function addRecipe(Request $request)
    {
        // Validasi data yang diinput oleh pengguna
        $request->validate([
            'recipe_name' => 'required|string',
            'description' => 'required|string',
            'preparation_time' => 'required|string',
            'cooking_time' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi gambar
        ]);

        // Upload gambar ke direktori public/storage/images
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('images', 'public');
        } else {
            $gambarPath = null;
        }

        // Buat resep baru
        $recipe = new Recipe;
        $recipe->recipe_name = $request->input('recipe_name');
        $recipe->description = $request->input('description');
        $recipe->preparation_time = $request->input('preparation_time');
        $recipe->cooking_time = $request->input('cooking_time');
        $recipe->gambar = $gambarPath;
        $recipe->author_id = null;
        $recipe->save();

        return redirect('/adminPage')->with('success', 'Recipe has been created successfully');
    }
}
