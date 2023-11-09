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
        'steps' => 'required|array',
        'steps.*' => 'required',
        'descriptions' => 'required|array',
        'descriptions.*' => 'required',
    ]);

    // Retrieve the input data for steps and descriptions
    $steps = $request->input('steps');
    $descriptions = $request->input('descriptions');

    // Loop through the submitted steps and descriptions and insert them into the database
    for ($i = 0; $i < count($steps); $i++) {
        $step = new Step([
            'recipe_id' => $recipe_id,
            'step_order' => $i + 1, // Use the index as the step order
            'description' => $descriptions[$i],
        ]);
        $step->save();
    }

    // Redirect back or to a specific page after insertion
    return redirect()->back()->with('success', 'Steps added successfully');
}

}
