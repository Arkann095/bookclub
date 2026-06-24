<?php

use App\Models\User;
use App\Models\Book;
use App\Models\Review;

test('страница открывается', function () {
    $response = $this->get('/community');

    $response->assertStatus(200);

    $response->assertSee('Сообщество');
});

test('Топ читателей и сейчас обсуждают', function () {

    $user = User::factory()->create();
    $book = Book::factory()->create();

    Review::factory()->for($user)->for($book)->create();

    $response = $this->get('/community');
    $response->assertStatus(200);

    $response->assertSee($user->name);
});
