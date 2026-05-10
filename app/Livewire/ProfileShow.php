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
    public $followers;
    public $following;
    public bool $isOwner = false;
    public bool $isFollowing = false;
    public string $activeTab = 'reviews';

    public function mount(User $user) {
    
        $user->loadCount('reviews', 'comments', 'followers', 'following');

        $this->user = $user;
        $this->isOwner = auth()->check() && auth()->id() === $user->id;

        $this->loadData();

    }

    public function toggleFollow() {

        if (!auth()->check()) return;
    
        if ($this->isFollowing) {
            auth()->user()->following()->detach($this->user->id);
            $this->isFollowing = false;
        } else {
            auth()->user()->following()->attach($this->user->id);
            $this->isFollowing = true;
        }
        
        $this->user->loadCount('followers', 'following');

        }

    public function loadData() {
    
        $this->reviews = $this->user->reviews()
            ->with('book')
            ->latest()
            ->get();

        $this->comments = $this->user->comments()
            ->with('book')
            ->latest()
            ->get();

        $this->followers = $this->user->followers()->get();
        $this->following = $this->user->following()->get();
    }

    public function render()
    {
        return view('livewire.profile-show');
    }
}