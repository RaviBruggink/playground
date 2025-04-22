<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
// removed because Route::resource is more efficient

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create/', [UserController::class, 'create'])->name('users.create');
// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::resource('users', UserController::class);
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

Route::get('/', HomeController::class);


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

