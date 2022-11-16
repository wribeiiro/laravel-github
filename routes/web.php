<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\FeedController::class, 'index'])->name('feed');

Auth::routes();

Route::get('/me', [App\Http\Controllers\MeController::class, 'index'])->name('me');
Route::get('/feed', [App\Http\Controllers\FeedController::class, 'index'])->name('feed');
Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::delete('/post/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

Route::post('/like/store', [App\Http\Controllers\LikeController::class, 'store'])->name('like.store');
Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');

Route::get('social/auth/{socialName}', [App\Http\Controllers\SocialAuthController::class, 'auth']);
Route::get('social/callback/{socialName}', [App\Http\Controllers\SocialAuthController::class, 'callback']);
Route::get('social/logout/{socialName}', [App\Http\Controllers\SocialAuthController::class, 'logout']);
