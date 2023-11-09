<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Step;

class StepController extends Controller
{
    public function stepUser($id)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            $recipe = Recipe::findOrFail($id);
            $step = Step::where('recipe_id', $id)->get();

            return view('stepUser', compact('recipe', 'step'));
        }
    }
}
