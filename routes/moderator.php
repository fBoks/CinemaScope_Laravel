<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\Moderator\PanelController as ModeratorPanelController;

Route::prefix('moderator')->middleware(['auth', 'moderator', 'active'])->group(function () {
    Route::redirect('/', 'home')->name('moderator');

    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('moderator.posts.delete');

    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'delete'])->name('moderator.posts.comments.delete');

    Route::get('panel', [ModeratorPanelController::class, 'index'])->name('moderator.panel');
});