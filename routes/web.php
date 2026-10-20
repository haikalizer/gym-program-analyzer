<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutProgramController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)
    ->name('dashboard');
});

require __DIR__.'/settings.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/workout-programs', [
        WorkoutProgramController::class,
        'index',
    ])->name('workout-programs.index');

    Route::get('/workout-programs/create', [
        WorkoutProgramController::class,
        'create',
    ])->name('workout-programs.create');

    Route::post('/workout-programs', [
        WorkoutProgramController::class,
        'store',
    ])->name('workout-programs.store');

    Route::get('/workout-programs/{workoutProgram}/exercises', [
        ExerciseController::class,
        'index',
    ])->name('workout-programs.exercises.index');

    Route::get('/workout-programs/{workoutProgram}/exercises/create', [
        ExerciseController::class,
        'create',
    ])->name('workout-programs.exercises.create');

    Route::post('/workout-programs/{workoutProgram}/exercises', [
        ExerciseController::class,
        'store',
    ])->name('workout-programs.exercises.store');

    
    Route::get(
        '/workout-programs/{workoutProgram}/exercises/{exercise}/edit',
        [ExerciseController::class, 'edit']
    )->name('workout-programs.exercises.edit');

    Route::put(
        '/workout-programs/{workoutProgram}/exercises/{exercise}',
        [ExerciseController::class, 'update']
    )->name('workout-programs.exercises.update');

    Route::delete(
        '/workout-programs/{workoutProgram}/exercises/{exercise}',
        [ExerciseController::class, 'destroy']
    )->name('workout-programs.exercises.destroy');

    
});