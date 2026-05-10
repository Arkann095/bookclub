<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
use App\Models\Comment;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $users = User::factory()->count(10)->create();

        $books = Book::factory()->count(20)->create();

        Review::factory()->count(30)->create([
            'user_id' => fn() => $users->random()->id,
            'book_id'  => fn() => $books->random()->id,
        ]);

        Comment::factory()->count(50)->create([
            'user_id' => fn() => $users->random()->id,
            'book_id'  => fn() => $books->random()->id,
        ]);

    }
}
