<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::with('exercises')
            ->orderBy('date', 'desc')
            ->get();

        return view('workouts.index', compact('workouts'));
    }

    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|string|max:255',
        ]);

        $workout = Workout::create($validated);

        return redirect()->route('workouts.show', $workout->id)
                         ->with('success', 'Session started! Now log your lifts.');
    }

    public function show(Workout $workout)
    {
        $workout->load('exercises');
        return view('workouts.show', compact('workout'));
    }

    public function edit(Workout $workout)
    {
        return view('workouts.edit', compact('workout'));
    }

    public function update(Request $request, Workout $workout)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|string|max:255',
        ]);

        $workout->update($validated);

        return redirect()->route('workouts.index')->with('success', 'Workout updated!');
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();

        return redirect()->route('workouts.index')->with('success', 'Session deleted.');
    }
}