<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/api/todo', [TodoController::class, "create"]);

Route::get("/users/login", [\App\Http\Controllers\UserController::class, "login"]);
Route::get("/users/current", [\App\Http\Controllers\UserController::class, "current"])
    ->middleware(['auth']);
Route::get("/api/users/current", [\App\Http\Controllers\UserController::class, "current"])
    ->middleware(['auth:token']);
Route::get('/simple-api/users/current', [UserController::class, "current"])
    ->middleware(['auth:simple-token']);

require __DIR__.'/auth.php';
