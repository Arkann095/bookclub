<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('страница регистрации открывается', function () {
    $response = $this->get('/register');
    $response->assertStatus(200);
});

test('новый пользователь может зарегистрироваться', function () {
    $response = $this->post('/register', [
        'name' => 'Имя',
        'email' => 'test@example.com',
        'password' => '111555999',
        'password_confirmation' => '111555999',
    ]);
    $response->dumpSession();
    $response->assertRedirect('/email/verify');
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});

test('страница входа открывается', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('пользователь может войти', function () {
    $user = User::factory()->create(['password' => bcrypt('password123')]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $this->assertAuthenticated();
});