<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/buku', [BooksController::class, 'index'])->name('buku');
    Route::get('/buku/search', [BooksController::class, 'search'])->name('search');
    Route::get('/buku/{id}/detail', [BooksController::class, 'show'])->name('books.show');
    Route::get('/reviews/{id}/show', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/tags/{tag}', [ReviewController::class, 'showBooksByTag'])->name('tags.show');
    Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
    Route::patch('/buku/{id}/toggle-editorial-pick', [BooksController::class, 'toggleEditorialPick'])->name('toggleEditorialPick');

    // Admin-specific routes with 'auth' and 'admin' middleware
    Route::middleware(['admin'])->group(function () {
        Route::get('/buku/create', [BooksController::class, 'create'])->name('create');
        // Route::post('/buku-store', [BooksController::class, 'store'])->name('store.buku');
        Route::delete('/buku/{id}', [BooksController::class, 'destroy'])->name('destroy');
        Route::post('/store-buku', [BooksController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [BooksController::class, 'edit'])->name('edit');
        Route::put('/buku/{id}/update', [BooksController::class, 'update'])->name('update');
        
    // Reviewer-specific routes, need both 'auth' and 'reviewer' middleware
    });
    Route::middleware(['reviewer'])->group(function () {
        Route::get('/reviews/create', [ReviewController::class, 'index'])->name('reviews.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });
    Route::middleware(['level'])->group(function () {
        Route::get('/reviews/create', [ReviewController::class, 'index'])->name('reviews.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });
});


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');

    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/sendemail', [SendEmailController::class, 'index'])->name('kirim-email');
Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');  