<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Book;
use App\Models\Review;
use App\Models\Comment;
use App\Events\FollowCreated;

use Illuminate\Support\Facades\DB;

class ProfileShow extends Component
{
    public User $user;
    public $reviews;
    public $comments;
    public $books;
    public $followers;
    public $following;
    public bool $isOwner;
    public bool $isFollowing;
    public bool $isProfileHidden;
    public string $activeTab = 'reviews';
    public $notifications;

    public function mount(User $user) {
    
        $user->loadCount('reviews', 'books', 'comments', 'followers', 'following');


        $this->user = $user;
        $this->isOwner = auth()->check() && auth()->id() === $user->id;

        $this->loadData();

        $this->isProfileHidden = $user->is_private;

        $this->isFollowing = $user->followers->contains(auth()->id());

        if (request()->has('tab') && request('tab') === 'notifications') {
            $this->activeTab = 'notifications';
            $this->markNotificationsAsRead();
        }

    }
    // Скрыть показать профиль
    public function dehydrate() {
    
        $this->user->update(['is_private' => $this->isProfileHidden]);
        
    }
    // Подписаться отписаться
    public function toggleFollow() {

        if (!auth()->check()) return;
    
        if ($this->isFollowing) {
            auth()->user()->following()->detach($this->user->id);
            $this->isFollowing = false;
        } else {
            auth()->user()->following()->attach($this->user->id);
            $this->isFollowing = true;
        }
        event(new FollowCreated($this->user));
        $this->user->loadCount('followers', 'following');

    }
    // Загрузка данных
    public function loadData() {
    
        $this->reviews = $this->user->reviews()
            ->with('book')
            ->latest()
            ->get();

        $this->comments = $this->user->comments()
            ->with('book')
            ->latest()
            ->get();

        $this->books = $this->user->books()->latest()->get();
        $this->followers = $this->user->followers()->get();
        $this->following = $this->user->following()->get();

        $this->notifications = DB::table('notifications')
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', $this->user->id)
            ->latest()
            ->get();
    }
    // Уведомления прочитаны - пометка
    public function markNotificationsAsRead()
    {
        DB::table('notifications')
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->notifications = DB::table('notifications')
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.profile-show');
    }
}