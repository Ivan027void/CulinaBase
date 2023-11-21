<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // Retrieve all recipes from the Recipe model
        $recipes = Recipe::all();
        // Retrieve non-admin users from the User model
        $users = User::where('role', '!=', 'admin')->get();
        
        // If there are no users, you can use your dummy data
        if ($users->isEmpty()) {
            $dummyUsers = [
                ['name' => 'User 1', 'email' => '@password', 'created_at' => '2023-01-15 10:30:00'],
                ['name' => 'User 2', 'email' => '@password', 'created_at' => '2023-02-20 14:45:00'],
                ['name' => 'User 3', 'email' => '@password', 'created_at' => '2023-03-25 09:15:00'],
                ['name' => 'User 4', 'email' => '@password', 'created_at' => '2023-04-10 12:00:00'],
                ['name' => 'User 5', 'email' => '@password', 'created_at' => '2023-05-05 16:20:00'],
            ];

            return view('adminPage', compact('recipes', 'dummyUsers'));
        }

        // If there are users, pass them to the view
        return view('adminPage', compact('recipes', 'users'));
    }

    public function editAdmin($id)
    {
        $recipe = Recipe::findOrFail($id);
        $this->authorize('edit', $recipe); // Check authorization
        $steps = Step::where('recipe_id', $id)->get();
        $ingredient = Ingredient::where('recipe_id', $id)->get();
        return view('editAdmin', compact('recipe', 'steps', 'ingredient'));
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

    public function updateAdmin(Request $request, $id)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Dapatkan recipe berdasarkan ID
        $recipe = Recipe::findOrFail($id);

        // Validasi input
        $this->validate($request, [
            'recipe_name' => 'required|string|max:255',
            'description' => 'required|string',
            'preparation_time' => 'required|string|max:255',
            'cooking_time' => 'required|string|max:255',
        ]);

        // Perbarui informasi resep
        $recipe->recipe_name = $request->input('recipe_name');
        $recipe->description = $request->input('description');
        $recipe->preparation_time = $request->input('preparation_time');
        $recipe->cooking_time = $request->input('cooking_time');
        $recipe->save();

        // Tampilkan pesan sukses
        Session::flash('success', 'Informasi resep berhasil diperbarui.');

        // Redirect ke halaman resep
        return redirect()->route('recipes.edit', $id)->with('success', 'Recipe has been updated successfully');
    }

    public function addIngredientAdmin(Request $request, $recipe_id)
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

    public function updateIngredientAdmin(Request $request, $recipe_id, $ingredientId)
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

        return redirect()->route('recipes.edit', $recipe_id)->with('success', 'Ingredient updated successfully');
    }


    public function deleteIngredientAdmin($recipe_id, $ingredientId)
    {
        $ingredient = Ingredient::find($ingredientId);

        if (!$ingredient) {
            return redirect()->route('recipes.edit', $recipe_id)->with('error', 'Ingredient not found');
        }

        $ingredient->delete();

        return redirect()->route('recipes.edit', $recipe_id)->with('success', 'Ingredient deleted successfully');
    }

    public function addStepAdmin(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'step_order' => 'required|integer',
            'description' => 'required|string',
        ]);

        // Create a new step
        Step::create([
            'recipe_id' => $id,
            'step_order' => $request->input('step_order'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('recipes.edit', $id)->with('success', 'Step added successfully');
    }

    public function updateStepAdmin(Request $request, $id, $stepId)
    {
        // Validate the request data
        $request->validate([
            'step_order' => 'required|integer',
            'description' => 'required|string',
        ]);

        // Find the step by ID
        $step = Step::findOrFail($stepId);

        // Update the step
        $step->update([
            'step_order' => $request->input('step_order'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('recipes.edit', $id)->with('success', 'Step updated successfully');
    }

    public function deleteStepAdmin($id, $stepId)
    {
        $step = Step::find($stepId);

        if (!$step) {
            return redirect()->route('recipes.edit', $id)->with('error', 'Step not found');
        }

        $step->delete();

        return redirect()->route('recipes.edit', $id)->with('success', 'Step delete successfully');
    }


}
