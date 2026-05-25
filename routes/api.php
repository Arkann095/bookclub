<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Book;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;

Route::get('/books', [BookController::class, 'index']);

Route::get('/books/{id}', [BookController::class, 'show']);

Route::apiResource('books.reviews', ReviewController::class);

Route::apiResource('books.comments', CommentController::class);

Route::get('/users/{user}/reviews', [UserController::class, 'showReviews']);

Route::get('/users/{user}', [UserController::class, 'show']);
