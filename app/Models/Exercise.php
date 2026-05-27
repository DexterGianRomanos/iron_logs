<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['workout_id', 'name', 'sets', 'reps', 'weight'];

    // An Exercise belongs to a specific Workout Session
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}