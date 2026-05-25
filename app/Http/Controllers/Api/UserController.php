<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user) {

        $user->loadCount('reviews', 'comments', 'followers', 'following');
        return response()->json($user);

    }

    public function showReviews(User $user) {

        $reviews = $user->reviews()->with('book')->latest()->get();
        return response()->json($reviews);

    }
}
