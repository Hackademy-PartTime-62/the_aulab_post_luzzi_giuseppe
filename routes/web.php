<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotte Pubbliche
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])->name('home');

// LISTA articoli (pubblici)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// FORM CREATE articolo (DEVE venire PRIMA della show)
Route::middleware('auth')->get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');

// STORE articolo
Route::middleware('auth')->post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');

// MOSTRA ARTICOLO (DEVE essere per ultima)
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

/*
|--------------------------------------------------------------------------
| Utenti registrati
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Edit + Update + Delete articoli
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}/update', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}/delete', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Richiesta revisore
    Route::get('/revisor/request', [RevisorController::class, 'requestForm'])->name('revisor.request');
    Route::post('/revisor/request/send', [RevisorController::class, 'sendRequest'])->name('revisor.request.send');
});

/*
|--------------------------------------------------------------------------
| Revisore
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isRevisor'])->group(function () {

    Route::get('/revisor/dashboard', [RevisorController::class, 'dashboard'])->name('revisor.dashboard');

    Route::post('/revisor/article/{article}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
    Route::post('/revisor/article/{article}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin/revisor-requests', [AdminController::class, 'revisorRequests'])
        ->name('admin.revisor_requests');

    Route::post('/admin/revisor-requests/{user}/approve', [AdminController::class, 'approve'])
        ->name('admin.revisor.approve');

    Route::post('/admin/revisor-requests/{user}/reject', [AdminController::class, 'reject'])
        ->name('admin.revisor.reject');
});
