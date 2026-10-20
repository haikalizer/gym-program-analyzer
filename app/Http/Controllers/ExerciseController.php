<?php

namespace App\Http\Controllers;

use App\Models\WorkoutProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExerciseController extends Controller
{
    public function index(WorkoutProgram $workoutProgram): Response
    {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        $workoutProgram->load('exercises');

        return Inertia::render('workout-programs/Exercises', [
            'program' => $workoutProgram,
        ]);
    }

    public function create(WorkoutProgram $workoutProgram): Response
    {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        return Inertia::render('workout-programs/CreateExercise', [
            'program' => $workoutProgram,
        ]);
    }

    public function store(
        Request $request,
        WorkoutProgram $workoutProgram
    ): RedirectResponse {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'muscle_group' => [
                'required',
                'string',
                'in:Chest,Back,Shoulders,Biceps,Triceps,Quadriceps,Hamstrings,Glutes,Calves,Abs,Forearms',
            ],
            'sets' => ['required', 'integer', 'min:1', 'max:100'],
            'reps' => ['required', 'integer', 'min:1', 'max:1000'],
            'weight' => ['required', 'numeric', 'min:0', 'max:99999.99'],
        ]);

        $workoutProgram->exercises()->create($validated);

        return to_route('workout-programs.exercises.index', $workoutProgram)
            ->with('success', 'Latihan berhasil ditambahkan.');
    }

    public function edit(
        WorkoutProgram $workoutProgram,
        \App\Models\Exercise $exercise
    ): Response {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        abort_unless(
            $exercise->workout_program_id === $workoutProgram->id,
            404
        );

        return Inertia::render('workout-programs/EditExercise', [
            'program' => $workoutProgram,
            'exercise' => $exercise,
        ]);
    }

    public function update(
        Request $request,
        WorkoutProgram $workoutProgram,
        \App\Models\Exercise $exercise
    ): RedirectResponse {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        abort_unless(
            $exercise->workout_program_id === $workoutProgram->id,
            404
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'muscle_group' => [
                'required',
                'string',
                'in:Chest,Back,Shoulders,Biceps,Triceps,Quadriceps,Hamstrings,Glutes,Calves,Abs,Forearms',
            ],
            'sets' => ['required', 'integer', 'min:1', 'max:100'],
            'reps' => ['required', 'integer', 'min:1', 'max:1000'],
            'weight' => ['required', 'numeric', 'min:0', 'max:99999.99'],
        ]);

        $exercise->update($validated);

        return to_route(
            'workout-programs.exercises.index',
            $workoutProgram
        )->with('success', 'Latihan berhasil diperbarui.');
    }

    public function destroy(
        WorkoutProgram $workoutProgram,
        \App\Models\Exercise $exercise
    ): RedirectResponse {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        abort_unless(
            $exercise->workout_program_id === $workoutProgram->id,
            404
        );

        $exercise->delete();

        return to_route(
            'workout-programs.exercises.index',
            $workoutProgram
        )->with('success', 'Latihan berhasil dihapus.');
    }

}