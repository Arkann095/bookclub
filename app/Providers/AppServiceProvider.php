<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Events\ReviewCreated;
use App\Listeners\SendReviewNotification;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Event::listen(
        //     ReviewCreated::class,
        //     SendReviewNotification::class,
        // );
        // Event::listen(
        //     \App\Events\CommentCreated::class,
        //     \App\Listeners\SendCommentNotification::class,
        // );
    }
}
