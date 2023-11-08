<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Recipe; // Sesuaikan dengan model Recipe yang Anda gunakan

class UserPageController extends Controller
{
    public function userPage()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Ambil semua resep yang dimiliki oleh pengguna
            $userRecipes = Recipe::where('author_id', $user->id)->get();

            return view('userPage', ['user' => $user, 'userRecipes' => $userRecipes]);
        } else {
            // Jika pengguna belum login, Anda dapat mengarahkannya ke halaman login atau menampilkan pesan yang sesuai.
            return redirect('/login');
        }
    }

    public function formUser()
    {
        return view('formUser');
    }

    public function createRecipe(Request $request)
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
        $recipe->author_id = Auth::id(); // Menggunakan ID pengguna yang sedang login sebagai author_id
        $recipe->save();

        return redirect('/user-page')->with('success', 'Recipe has been created successfully');
    }

    public function ingredientUser()
    {
        return view('ingredientUser');
    }

    public function stepUser()
    {
        return view('stepUser');
    }
}
