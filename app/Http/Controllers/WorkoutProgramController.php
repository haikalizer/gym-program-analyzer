<?php

namespace App\Http\Controllers;

use App\Models\WorkoutProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorkoutProgramController extends Controller
{
    public function index(): Response
    {
        $programs = WorkoutProgram::query()
            ->where('user_id', auth()->id())
            ->withCount('exercises')
            ->latest()
            ->get();

        return Inertia::render('workout-programs/Index', [
            'programs' => $programs,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('workout-programs/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $request->user()->workoutPrograms()->create($validated);

        return to_route('workout-programs.index')
            ->with('success', 'Program latihan berhasil dibuat.');
    }


    public function destroy(WorkoutProgram $workoutProgram): RedirectResponse
    {
        // Pastikan program milik pengguna yang sedang login
        abort_unless(
            $workoutProgram->user_id === auth()->id(),
            403
        );

        // Hapus semua exercise dalam program
        $workoutProgram->exercises()->delete();

        // Hapus program latihan
        $workoutProgram->delete();

        return to_route('workout-programs.index')
            ->with('success', 'Program latihan berhasil dihapus.');
    }
}