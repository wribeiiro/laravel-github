<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('github/auth', [App\Http\Controllers\GithubAuthController::class, 'auth']);
Route::get('github/callback', [App\Http\Controllers\GithubAuthController::class, 'callback']);
Route::get('github/logout', [App\Http\Controllers\GithubAuthController::class, 'logout']);

Route::get('discord/auth', [App\Http\Controllers\DiscordAuthController::class, 'auth']);
Route::get('discord/callback', [App\Http\Controllers\DiscordAuthController::class, 'callback']);
Route::get('discord/logout', [App\Http\Controllers\DiscordAuthController::class, 'logout']);
