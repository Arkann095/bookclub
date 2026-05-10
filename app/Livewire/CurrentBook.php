<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Book;
use App\Models\Review;
use App\Models\Comment;

class CurrentBook extends Component
{
    public Book $book;
    public int $reviewRating = 0;
    public string $reviewBody = '';
    public string $commentBody = '';

    public string $replyBody = '';

    public array $replyOpen = [];

    public array $showAllReplies = [];

    public function mount(Book $book)
    {
        $book->load('reviews.user', 'comments.user', 'comments.replies.user');
        $this->book = $book;
    }

    public function storeReview() {
    
        $this->validate([
            'reviewRating' => ['required', 'integer', 'min:1', 'max:5'],
            'reviewBody' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'reviewRating.required' => 'Поставьте оценку книге',
            'reviewRating.min' => 'Оценка должна быть не меньше 1',
            'reviewRating.max' => 'Оценка должна быть не больше 5',
            'reviewBody.required' => 'Напишите текст рецензии',
            'reviewBody.min' => 'Рецензия должна быть не короче 10 символов',
            'reviewBody.max' => 'Рецензия должна быть не длиннее 2000 символов',
        ], [
            'reviewRating' => 'Оценка',
            'reviewBody' => 'Текст рецензии',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'book_id' => $this->book->id,
            'rating' => $this->reviewRating,
            'body' => $this->reviewBody,
        ]);

        $this->book->load('reviews.user');
        $this->reset('reviewRating', 'reviewBody');
    }

    public function storeComment() {
    
        $this->validate([
            'commentBody' => ['required', 'string', 'min:3', 'max:2000'],
        ], [
            'commentBody.required' => 'Напишите текст комментария',
            'commentBody.min' => 'Комментарий должен быть не короче 3 символов',
            'commentBody.max' => 'Комментарий должен быть не длиннее 2000 символов',
        ], [
            'commentBody' => 'Текст комментария',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'book_id' => $this->book->id,
            'parent_id' => null,
            'body' => $this->commentBody,
        ]);

        $this->book->load('comments.user', 'comments.replies.user');
        $this->reset('commentBody');
    }
    
    public function storeReply(int $parentId) {

        $this->validate([
            'replyBody' => ['required', 'string', 'min:3'],
        ], [
            'replyBody.required' => 'Напишите свой комментарий',
            'replyBody.min' => 'Не короче 3 символов',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'book_id' => $this->book->id,
            'parent_id' => $parentId,
            'body' => $this->replyBody
        ]);

        $this->reset('replyBody');
        unset($this->replyOpen[$parentId]);
        $this->book->load('comments.user', 'comments.replies.user');

    }

    public function toggleReplies(int $commentId) {
        
        if (isset($this->showAllReplies[$commentId])) {
            unset($this->showAllReplies[$commentId]);
        } 
        else {
            $this->showAllReplies[$commentId] = true;
        }
    }

    public function render()
    {
        return view('livewire.current-book');
    }
}