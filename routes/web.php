<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameRightController;
use App\Http\Controllers\ScoreController;
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


Route::middleware('guest')->group(function(){
    Route::get('/' , [AuthController::class, 'loginPage'])->name('login');
    Route::get('/login' , [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login' , [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function(){
    Route::post('/logout' , [AuthController::class, 'logout'])->name('logout');

    Route::resource('users' , UserController::class);
    Route::put('users/{user}/password' , [UserController::class, 'updatePassword'])->name('users.updatePassword');

    Route::resource('games' , GameController::class);

    Route::resource('games/{game}/game-rights' , GameRightController::class)->only( 'store','create','destroy');

    Route::resource('games/{game}/scores' , ScoreController::class)->only( 'index','create','store','edit','update','destroy');

});

