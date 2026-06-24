<?php

namespace App\Listeners;

use App\Events\FollowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class SendFollowNotification
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
    public function handle(FollowCreated $event): void
    {
        $followed = $event->followed;
        $follower = auth()->user();

        DB::table('notifications')->insert([
            'type' => 'follow',
            'notifiable_type' => User::class,
            'notifiable_id' => $followed->id,
            'data' => json_encode([
                'follower_name' => $follower->name,
                'follower_id' => $follower->id,
            ]),
            'created_at' => now(),
        ]);
    }
}
