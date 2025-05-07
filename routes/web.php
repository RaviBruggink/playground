<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;



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

Route::get('/projects/custom/graph', function () {
    return view('projects.custom.graph');
})->name('projects.custom.graph');

// OF gebruik een controller (aanbevolen voor complexere logica)
Route::get('/model-overview', [ModelController::class, 'index']);



