<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;



Route::resource('users', UserController::class);
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

Route::get('/', HomeController::class);


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/models', function () {
    return view('models.index');
})->name('models.index');



