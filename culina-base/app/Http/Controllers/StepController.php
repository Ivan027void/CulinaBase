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

    public function storeStep(Request $request, $recipe_id)
{
    // Validate the input data
    $request->validate([
        'descriptions' => 'required',
    ]);

    // Retrieve the input data for description
    $descriptions = $request->input('descriptions');

    

    // Loop through the submitted descriptions and insert them into the database
    foreach ($descriptions as $key => $description) {
        // Get the next step order
        $stepOrder = Step::where('recipe_id', $recipe_id)->max('step_order') + 1;
        $step = new Step([
            'description' => $description,
            'recipe_id' => $recipe_id,
            'step_order' => $stepOrder++,
        ]);
        $step->save();
    }

    // Redirect back or to a specific page after insertion
    return redirect()->back()->with('success', 'Steps added successfully');
}

}
