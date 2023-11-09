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

    public function addStep(Request $request, $recipe_id)
    {

        $request->validate([
            'step_order' => 'required|integer',
            'description' => 'required|string',
        ]);
        
        $step = new Step;
        $step->recipe_id = $recipe_id;
        $step->step_order = $request->input('step_order');
        $step->description = $request->input('description');
        $step->save();

        return response()->json(['message' => 'Step added successfully'], 200);
    }

}
