<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use App\Models\Book;

class CommunityController extends Controller
{
    public function index()
    {
        $activities = Review::with('user', 'book')
            ->latest()
            ->paginate(20);

        $topReaders = User::withCount('reviews')
            ->orderByDesc('reviews_count')
            ->take(5)
            ->get();

        $popularBooks = Book::withCount('comments')
            ->orderByDesc('comments_count')
            ->take(5)
            ->get();

        return view('community.index', compact('activities', 'topReaders', 'popularBooks'));
    }
}
