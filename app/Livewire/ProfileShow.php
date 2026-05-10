<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Review;
use App\Models\Comment;

class ProfileShow extends Component
{
    public User $user;
    public $reviews;
    public $comments;
    public bool $isOwner = false;
    public string $activeTab = 'reviews';

    public function mount(User $user)
    {
        $user->loadCount('reviews', 'comments', 'followers', 'following');

        $this->user = $user;
        $this->reviews = Review::where('user_id', $user->id)
            ->with('book')
            ->latest()
            ->get();

        $this->comments = Comment::where('user_id', $user->id)
            ->with('book')
            ->latest()
            ->get();

        $this->isOwner = auth()->check() && auth()->id() === $user->id;
    }

    public function render()
    {
        return view('livewire.profile-show');
    }
}