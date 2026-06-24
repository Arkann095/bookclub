<?php

use App\Http\Controllers\ProfileSettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Community\CommunityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Books\BookController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Livewire\CurrentBook;
use App\Livewire\ProfileShow;
use App\Livewire\ProfileFollowers;
use App\Livewire\Shelf;

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

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/shelf', Shelf::class)->name('profile.shelf');
    Route::view('/profile/edit', 'profile.profile-edit')->name('profile.edit');
    Route::put('/profile', [ProfileSettingsController::class, 'update'])->name('profile.update');
    Route::view('/profile/book-create', 'books.create.create')->name('book.create');
    Route::post('/profile/book-create', [BookController::class, 'store']);
    Route::get('/profile/{user}/followers', ProfileFollowers::class)->name('profile.followers');
    
    Route::post('/books/{book}/shelf', [BookController::class, 'addBook'])->name('books.shelf.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
});

Route::get('/profile/{user}', ProfileShow::class)->name('profile.show');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('success', 'Email подтверждён!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Ссылка отправлена!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::get('/books/{book}/download', [BookController::class, 'downloadBook'])->name('books.download');

Route::view('/about', 'about.about')->name('about');
Route::view('/contacts', 'contacts.contacts')->name('contacts');
Route::view('/api', 'api')->name('api');

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return back();
})->name('lang.switch');