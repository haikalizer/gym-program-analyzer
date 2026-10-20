<?php

namespace App\Http\Controllers;

use App\Models\WorkoutProgram;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $programs = WorkoutProgram::query()
            ->where('user_id', auth()->id())
            ->withCount('exercises')
            ->latest()
            ->get();

        return Inertia::render('Dashboard', [
            'programs' => $programs,
            'stats' => [
                'totalPrograms' => $programs->count(),
                'totalExercises' => $programs->sum('exercises_count'),
                'weeklySets' => 0,
            ],
        ]);
    }
}