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
        // Retrieve recipe details
        $recipe = Recipe::findOrFail($id);

        // Retrieve steps for the recipe
        $steps = Step::where('recipe_id', $id)->orderBy('step_order')->get();

        return view('stepUser', compact('recipe', 'steps'));
    }

    public function addStep(Request $request, $id)
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

        return redirect()->route('step-user', $id)->with('success', 'Step added successfully');
    }

    public function updateStep(Request $request, $id, $stepId)
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

        return redirect()->route('step-user', $id)->with('success', 'Step updated successfully');
    }


    public function deleteStep($id, $stepId)
    {
        $step = Step::find($stepId);
    
        if (!$step) {
            return redirect()->route('step-user', $id)->with('error', 'Step not found');
        }
    
        $step->delete();
    
        return redirect()->route('step-user', $id)->with('success', 'Step delete successfully');
    }
    
}
