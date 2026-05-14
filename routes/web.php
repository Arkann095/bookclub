<?php

use App\Http\Controllers\ProfileSettingsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Community\CommunityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Books\BookController;

use App\Livewire\CurrentBook;
use App\Livewire\ProfileShow;
use App\Livewire\ProfileFollowers;

Route::get('/', function() {
    return view('index');
});

Route::view('/books', 'books.booklist.books')->name('books.index');
Route::get('/books/{book}', CurrentBook::class)->name('books.show');
Route::get('/community', [CommunityController::class, 'index'])->name('community');

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::view('/profile/edit', 'profile.profile-edit')->name('profile.edit');
    Route::get('/profile/{user}/followers', ProfileFollowers::class)->name('profile.followers');
    Route::put('/profile', [ProfileSettingsController::class, 'update'])->name('profile.update');
    Route::view('/profile/book-create', 'books.create.create')->name('book.create');
    Route::post('/profile/book-create', [BookController::class, 'store']);


    
});

Route::get('/profile/{user}', ProfileShow::class)->name('profile.show');

