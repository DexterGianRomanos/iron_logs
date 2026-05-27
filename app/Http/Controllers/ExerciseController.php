<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    // SAVE LIFT: Add a specific exercise to a workout session
    public function store(Request $request, Workout $workout)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'weight' => 'nullable|numeric|min:0',
        ]);

        // Attach the exercise to the correct workout ID
        $validated['workout_id'] = $workout->id;

        Exercise::create($validated);

        // Refresh the page so you can immediately see the added exercise
        return back();
    }

    // DELETE LIFT: Remove an exercise if you made a typo
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return back();
    }
}