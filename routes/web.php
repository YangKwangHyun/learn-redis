<?php

use Illuminate\Support\Facades\Route;

// use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// LessonController의 index 호출
Route::get('/', [\App\Http\Controllers\LessonsController::class, 'index']);

// LessonController의 show 호출
Route::get('/lessons/{lesson}', [\App\Http\Controllers\LessonsController::class, 'show']);
