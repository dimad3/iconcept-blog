<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Protect routes with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::get('my-posts', [PostController::class, 'myPosts'])->name('my_posts');

    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

    // Allow only post authors to edit/delete their posts
    Route::middleware(['can:manage-post,post'])->group(function () {
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // Comments (only logged-in users can create/delete)
    // Route::resource('comments', CommentController::class)->only(['store', 'destroy'])->middleware(['can:manage-comment,comment']);
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware(['can:manage-comment,comment']);
});

// include the authentication routes defined in auth.php
require __DIR__ . '/auth.php';

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('categories/{category}/posts', [PostController::class, 'categoryPosts'])->name('categories.posts.index');
