<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

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

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('health', HealthCheckResultsController::class)->middleware('admin');

    Route::get('/messages/{user_id?}', [\App\Http\Controllers\MessageController::class, 'index']);
    Route::post('/messages/{user_id}/send', [\App\Http\Controllers\MessageController::class, 'store']);
    Route::post('/messages/{id}/delete', [\App\Http\Controllers\MessageController::class, 'destroy']);

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::get('/users/edit/{id}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::post('/users/delete/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
});

require __DIR__.'/auth.php';
