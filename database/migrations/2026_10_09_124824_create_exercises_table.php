<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();

            $table->foreignId('workout_program_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('muscle_group');
            $table->unsignedInteger('sets');
            $table->unsignedInteger('reps');
            $table->decimal('weight', 7, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};