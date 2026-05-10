<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Community\CommunityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Books\BookController;

use App\Livewire\CurrentBook;
use App\Livewire\ProfileShow;

Route::get('/', function() {
    return view('index');
});

Route::view('/books', 'books.booklist.books')->name('books.index');
Route::get('/books/{book}', CurrentBook::class)->name('books.show');
Route::get('/community', [CommunityController::class, 'index'])->name('community');

Route::get('/profile/{user}', ProfileShow::class)->name('profile.show');

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    
});


