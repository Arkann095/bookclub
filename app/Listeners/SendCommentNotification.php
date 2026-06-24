<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SendCommentNotification
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
    public function handle(CommentCreated $event): void
    {
        $comment = $event->comment;
        $owner = $comment->book->user;

        if ($owner && $owner->id !== $comment->user_id) {
            DB::table('notifications')->insert([
                'type' => 'comment',
                'notifiable_type' => User::class,
                'notifiable_id' => $owner->id,
                'data' => json_encode([
                    'user_name' => $comment->user->name,
                    'book_title' => $comment->book->title,
                    'book_id' => $comment->book->id,
                ]),
                'created_at' => now(),
            ]);
        }
    }
}
