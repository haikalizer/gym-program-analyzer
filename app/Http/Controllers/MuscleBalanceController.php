<?php

namespace App\Http\Controllers;

use App\Models\WorkoutProgram;
use Inertia\Inertia;
use Inertia\Response;

class MuscleBalanceController extends Controller
{
    public function index(): Response
    {
        $programs = WorkoutProgram::query()
            ->where('user_id', auth()->id())
            ->with('exercises')
            ->latest()
            ->get();

        return Inertia::render('workout-programs/MuscleBalance', [
            'programs' => $programs,
        ]);
    }

    public function show(WorkoutProgram $workoutProgram): Response
    {
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        $analysis = $workoutProgram->exercises
            ->groupBy('muscle_group')
            ->map(function ($exercises, $muscleGroup) {
                return [
                    'muscle_group' => $muscleGroup,
                    'total_sets' => $exercises->sum('sets'),
                    'total_exercises' => $exercises->count(),
                ];
            })
            ->values();

        return Inertia::render('workout-programs/MuscleBalance', [
            'programs' => WorkoutProgram::where('user_id', auth()->id())
                ->latest()
                ->get(['id', 'name']),
            'selectedProgram' => $workoutProgram,
            'analysis' => $analysis,
        ]);
    }
}
