<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['user_id', 'date', 'type'];

    // A Workout belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A Workout has many Exercises
    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}