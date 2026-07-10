<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [UserController::class, 'create'])->name('register');

Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.process');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.mine');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

});