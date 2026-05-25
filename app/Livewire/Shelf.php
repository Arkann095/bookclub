<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;

class Shelf extends Component
{
    public $tab = 'reading';
    public User $user;

    public function mount() {

        $this->user = auth()->user()->load('shelves.book');

    }

    public function render()
    {
        return view('livewire.shelf');
    }
}
