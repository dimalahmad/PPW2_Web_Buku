<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/buku', [BooksController::class, 'index'])->name('buku');
    Route::get('/buku/search', [BooksController::class, 'search'])->name('search');
    Route::get('/buku/{id}/detail', [BooksController::class, 'show'])->name('books.show');

    // Grup rute khusus admin dengan middleware 'auth' dan 'admin'
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/buku/create', [BooksController::class, 'create'])->name('create');
        Route::post('/buku-store', [BooksController::class, 'store'])->name('store.buku');
        Route::delete('/buku/{id}', [BooksController::class, 'destroy'])->name('destroy');
        Route::post('/store-buku', [BooksController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [BooksController::class, 'edit'])->name('edit');
        Route::put('/buku/{id}/update', [BooksController::class, 'update'])->name('update');
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