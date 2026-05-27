<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('exercises', function (Blueprint $table) {
        $table->id();
        // This links the exercise to a specific workout session
        $table->foreignId('workout_id')->constrained()->onDelete('cascade');
        $table->string('name'); // e.g., "Bench Press"
        $table->integer('sets'); // e.g., 3
        $table->integer('reps'); // e.g., 10
        $table->decimal('weight', 5, 2)->nullable(); // e.g., 50.50 (in kg or lbs)
        $table->timestamps();
    });
}
};
