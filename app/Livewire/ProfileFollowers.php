<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ProfileFollowers extends Component
{
    public User $user;
    public string $tab = 'followers';

    public $followers;   
    public $following;   

    public function mount(User $user) {
    
        $this->user = $user;
        $this->loadData();

    }

    public function loadData() {
    
        $this->followers = $this->user->followers()->get();
        $this->following = $this->user->following()->get();

    }

    public function removeFollower($followerId) {
    
        $this->user->followers()->detach($followerId);
        $this->loadData();

    }

    public function unfollow($followedId) {
    
        $this->user->following()->detach($followedId);
        $this->loadData();

    }

    public function render() {
    
        return view('livewire.profile-followers');

    }
}