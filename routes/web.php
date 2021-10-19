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

Route::get('social/auth/{socialName}', [App\Http\Controllers\SocialAuthController::class, 'auth']);
Route::get('social/callback/{socialName}', [App\Http\Controllers\SocialAuthController::class, 'callback']);
Route::get('social/logout/{socialName}', [App\Http\Controllers\SocialAuthController::class, 'logout']);
