<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

// removed because Route::resource is more efficient

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create/', [UserController::class, 'create'])->name('users.create');
// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::resource('users', UserController::class);

Route::get('/', function () {
    $users = User::latest()->get();
    return view('home', compact('users'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

