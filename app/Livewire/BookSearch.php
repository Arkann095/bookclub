<?php

namespace App\Livewire;

use App\Models\Book;

use Livewire\Component;
use Livewire\WithPagination;

use Ramsey\Uuid\Type\Integer;



class BookSearch extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch() {
    
        $this->resetPage();

    }

    public function render() {
    
        $books = Book::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('author', 'like', '%' . $this->search . '%');
                });
            })
            ->withAvg('reviews', 'rating')
            ->latest()
            ->paginate(8);

        return view('livewire.book-search', compact('books'));
    }
}