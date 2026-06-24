<?php

namespace App\Listeners;

use App\Events\ReviewCreated;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ReviewNotification;

class SendReviewNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReviewCreated $event): void
    {
        $review = $event->review;
        $owner = $review->book->user;

        if ($owner && $owner->id !== $review->user_id) {
            DB::table('notifications')->insert([
                'type' => 'review',
                'notifiable_type' => User::class,
                'notifiable_id' => $owner->id,
                'data' => json_encode([
                    'user_name' => $review->user->name,
                    'book_title' => $review->book->title,
                    'book_id' => $review->book->id,
                ]),
                'created_at' => now(),
            ]);
        }
    }
}
