<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/goal-evaluations', [\App\Http\Controllers\GoalEvaluationController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('goal-evaluations.store');
