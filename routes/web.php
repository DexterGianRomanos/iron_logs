<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ExerciseController;

// Redirect homepage to workouts
Route::get('/', function () {
    return redirect()->route('workouts.index');
});

// Workout routes
Route::get('/workouts',                  [WorkoutController::class, 'index'])->name('workouts.index');
Route::get('/workouts/create',           [WorkoutController::class, 'create'])->name('workouts.create');
Route::post('/workouts',                 [WorkoutController::class, 'store'])->name('workouts.store');
Route::get('/workouts/{workout}',        [WorkoutController::class, 'show'])->name('workouts.show');
Route::get('/workouts/{workout}/edit',   [WorkoutController::class, 'edit'])->name('workouts.edit');
Route::put('/workouts/{workout}',        [WorkoutController::class, 'update'])->name('workouts.update');
Route::delete('/workouts/{workout}',     [WorkoutController::class, 'destroy'])->name('workouts.destroy');

// Exercise routes
Route::post('workouts/{workout}/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
Route::delete('exercises/{exercise}',       [ExerciseController::class, 'destroy'])->name('exercises.destroy');