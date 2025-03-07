<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;

Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('throttle:5,1');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:10,1');

Route::middleware(['auth:api', 'throttle:60,1'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/projects', ProjectController::class);
    Route::apiResource('/timesheets', TimesheetController::class);
    Route::apiResource('/attributes', AttributeController::class);
    Route::apiResource('/attribute-values', AttributeValueController::class);
});
