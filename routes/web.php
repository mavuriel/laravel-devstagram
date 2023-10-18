<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/signup', [RegisterController::class, 'index'])->name('signup.index');
Route::post('/signup', [RegisterController::class, 'store'])->name('signup.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/edit', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/edit', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::post('/{user:username}/post/{post}', [CommentController::class, 'store'])->name('comment.store');

Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('like.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('like.destroy');

Route::post('/image', [ImageController::class, 'store'])->name('image.store');

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('follower.store');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('follower.destroy');




