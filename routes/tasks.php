<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');

Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])
    ->name('tasks.complete');

Route::patch('/tasks/{id}/reopen', [TaskController::class, 'reopen'])
    ->name('tasks.reopen');
