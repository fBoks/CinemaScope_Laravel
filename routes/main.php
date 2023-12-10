<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::redirect('/home', '/')->name('home.redirect');

Route::get('register', [RegisterController::class,'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('logout', [LogoutController::class, 'index'])->name('logout');

Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::get('films', [FilmController::class, 'index'])->name('films');
Route::get('films/{film}', [FilmController::class, 'show'])->name('films.show');