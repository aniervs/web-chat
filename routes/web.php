<?php

use App\Http\Controllers\WelcomeController;
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

Route::get('/', WelcomeController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/messages/{user_id?}', [\App\Http\Controllers\MessageController::class, 'index'])->middleware('auth');
Route::post('/messages/{user_id}/send', [\App\Http\Controllers\MessageController::class, 'store'])->middleware('auth');
Route::post('/messages/{id}/delete/', [\App\Http\Controllers\MessageController::class, 'destroy'])->middleware('auth');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
//Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);

require __DIR__.'/auth.php';
