<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Shelf as ShelfModel;

class Shelf extends Component
{
    public $tab = 'reading';
    public User $user;

    public function mount() {

        $this->user = auth()->user()->load('shelves.book');

    }

    public function changeStatus($id, $status) {

        $shelf = ShelfModel::findOrFail($id);

        if($status === 'want_to_read') {

            $shelf->started_at = null;
            $shelf->finished_at = null;

        }

        if ($status === 'read') {

            $shelf->finished_at = now();

        }

        if ($status === 'reading') {
            
            $shelf->started_at = now();

        }

        $shelf->status = $status;
        $shelf->save();

        $this->user->load('shelves.book');

    }

    public function render()
    {
        return view('livewire.shelf');
    }
}
