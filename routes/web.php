<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LivewireController;

/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| Resource Controllers
|--------------------------------------------------------------------------
*/
Route::resource('users', UserController::class);

Route::resource('projects', ProjectController::class)
     ->only(['index', 'show'])
     ->names([
         'index' => 'projects.index',
         'show'  => 'projects.show',
     ]);

/*
|--------------------------------------------------------------------------
| Model Pages
|--------------------------------------------------------------------------
*/
Route::name('models.')->group(function () {
    // List of models
    Route::view('/models', 'models.index')->name('index');
    // More complex overview via controller
    Route::get('/model-overview', [ModelController::class, 'index'])->name('overview');
});

/*
|--------------------------------------------------------------------------
| Custom Project Routes
|--------------------------------------------------------------------------
*/
Route::prefix('projects/custom')->name('projects.custom.')->group(function () {
    Route::view('graph', 'projects.custom.graph')->name('graph');
});

/*
|--------------------------------------------------------------------------
| Livewire Assignment
|--------------------------------------------------------------------------
*/
Route::get('/livewire-assignment', [LivewireController::class, 'index'])
     ->name('livewire.assignment');
