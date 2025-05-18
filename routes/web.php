<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LivewireController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Static Pages
Route::get('/', HomeController::class)->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Projects (Public)
Route::resource('projects', ProjectController::class)
     ->only(['index', 'show'])
     ->names([
         'index' => 'projects.index',
         'show'  => 'projects.show',
     ]);

// Custom Project Routes
Route::prefix('projects/custom')->name('projects.custom.')->group(function () {
    Route::view('graph', 'projects.custom.graph')->name('graph');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Users Management
    Route::resource('users', UserController::class);
    
    // Models Management
    Route::view('/models', 'models.index')->name('models.index');
    Route::get('/model-overview', [ModelController::class, 'index'])->name('models.overview');
    
    // Livewire Assignment (if needed in admin)
    Route::get('/livewire-assignment', [LivewireController::class, 'index'])
         ->name('livewire.assignment');
});
