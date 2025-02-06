<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Protect routes with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Only authorized users can manage their posts
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::get('my-posts', [PostController::class, 'myPosts'])->name('my_posts');

    // Comments (only logged-in users can create/delete)
    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
});

// include the authentication routes defined in auth.php
require __DIR__ . '/auth.php';
