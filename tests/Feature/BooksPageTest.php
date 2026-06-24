<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('каталог книг открывается', function () {
    $response = $this->get('/books');
    $response->assertStatus(200);
});

test('страница книги открывается', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create(['user_id' => $user->id]);

    $response = $this->get('/books/' . $book->id);
    $response->assertStatus(200);
});

test('на странице книги отображается название и автор', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create(['user_id' => $user->id]);

    $response = $this->get('/books/' . $book->id);
    $response->assertSee($book->title);
    $response->assertSee($book->author);
});

test('несуществующая книга возвращает 404', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create(['user_id' => $user->id]);

    $nonExistentId = $book->id + 1000;

    $response = $this->get('/books/' . $nonExistentId);
    $response->assertStatus(404);
});

test('авторизованный пользователь может создать книгу', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $response = $this->actingAs($user)->post('/profile/book-create', [
        'title' => 'Новая книга',
        'author' => 'Автор',
        'description' => 'Описание книги',
        'published_year' => 2026,
        'isbn' => '978-1234567890',
    ]);

    $response->assertRedirect('/books');
    $this->assertDatabaseHas('books', ['title' => 'Новая книга']);
});

test('гость не может создать книгу', function () {
    $response = $this->post('/profile/book-create', [
        'title' => 'Новая книга',
        'author' => 'Автор',
    ]);

    $response->assertRedirect('/login');
    $this->assertDatabaseMissing('books', ['title' => 'Новая книга']);
});

test('авторизованный пользователь видит кнопку добавить на полку', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create([
        'user_id' => $user->id,
        'book_file' => 'test.pdf',
    ]);

    $response = $this->actingAs($user)->get('/books/' . $book->id);
    $response->assertSee('Добавить на полку');
});

test('гость не видит кнопку добавить на полку', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create(['user_id' => $user->id]);

    $response = $this->get('/books/' . $book->id);
    $response->assertDontSee('Добавить на полку');
});