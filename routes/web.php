<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware(['auth:sanctum'])->get('/',  [HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum'])->get('/task',       [TaskController::class, 'index'])->name('task.index');
Route::middleware(['auth:sanctum'])->post('/task',      [TaskController::class, 'store'])->name('task.store');
Route::middleware(['auth:sanctum'])->patch('/task',     [TaskController::class, 'update'])->name('task.update');

