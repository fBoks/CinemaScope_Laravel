<?php

use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Posts\CommentController;
use Illuminate\Support\Facades\Route;

// Route::prefix('user')->as('user.')->middleware(['auth', 'active'])->group(function () {
Route::prefix('user')->middleware(['auth', 'active'])->group(function () {
    Route::redirect('/', 'user/posts')->name('user');

    Route::get('profile/{user}', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('user.profile.update');

    Route::get('posts', [PostController::class, 'index'])->name('user.posts');
    Route::get('posts/create', [PostController::class, 'create'])->name('user.posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('user.posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('user.posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('user.posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('user.posts.update');
    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('user.posts.delete');

    Route::get('posts/{post}/comments/', [CommentController::class, 'create'])->name('user.posts.comments.create');
    Route::post('posts/{post}/comments/', [CommentController::class, 'store'])->name('user.posts.comments.store');
    Route::get('posts/{post}/comments/{comment}', [CommentController::class, 'show'])->name('user.posts.comments.show');
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'delete'])->name('user.posts.comments.delete');
});