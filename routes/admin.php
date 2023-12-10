<?php 

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PanelController as AdminPanelController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\Films\FilmController;
use App\Http\Controllers\admin\films\FilmGenreController;
use App\Http\Controllers\Admin\Films\CinemaWorkerController;
use App\Http\Controllers\Admin\Films\CinemaWorkerRoleController;

Route::prefix('admin')->middleware(['auth', 'admin', 'active'])->group(function () {
    Route::redirect('/', 'admin/panel')->name('admin');

    Route::get('statistics', [StatisticsController::class, 'index'])->name('admin.statistics');

    Route::get('panel', [AdminPanelController::class, 'index'])->name('admin.panel');
    
    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('admin.posts.delete');

    Route::get('countries', [CountryController::class, 'index'])->name('admin.countries');
    Route::post('countries', [CountryController::class, 'store'])->name('admin.countries.store');
    Route::delete('countries/{country}', [CountryController::class, 'delete'])->name('admin.countries.delete');

    Route::get('films/create', [FilmController::class, 'create'])->name('admin.films.create');
    Route::post('films/', [FilmController::class, 'store'])->name('admin.films.store');
    Route::get('films/{film}/edit', [FilmController::class, 'edit'])->name('admin.films.edit');
    Route::put('films/{film}', [FilmController::class, 'update'])->name('admin.films.update');
    Route::delete('films/{film}', [FilmController::class, 'delete'])->name('admin.films.delete');

    Route::get('genres', [FilmGenreController::class, 'index'])->name('admin.films.genres');
    Route::post('genres', [FilmGenreController::class, 'store'])->name('admin.films.genres.store');
    Route::delete('genre/{genre}', [FilmGenreController::class, 'delete'])->name('admin.films.genres.delete');

    Route::get('workers', [CinemaWorkerController::class, 'index'])->name('admin.films.workers');
    Route::get('workers/create', [CinemaWorkerController::class, 'create'])->name('admin.films.workers.create');
    Route::post('workers', [CinemaWorkerController::class, 'store'])->name('admin.films.workers.store');
    Route::get('workers/{worker}', [CinemaWorkerController::class, 'show'])->name('admin.films.workers.show');
    Route::get('workers/{worker}/edit', [CinemaWorkerController::class, 'edit'])->name('admin.films.workers.edit');
    Route::put('workers/{worker}', [CinemaWorkerController::class, 'update'])->name('admin.films.workers.update');
    Route::delete('workers/{worker}', [CinemaWorkerController::class, 'delete'])->name('admin.films.workers.delete');

    Route::post('workersRoles/', [CinemaWorkerRoleController::class, 'store'])->name('admin.films.workers.role.store');
    Route::delete('workersRoles/{workerRole}', [CinemaWorkerRoleController::class, 'delete'])->name('admin.films.workers.role.delete');
});