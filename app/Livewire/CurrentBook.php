<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Book;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Shelf;
use App\Events\ReviewCreated;

use App\Events\CommentCreated;

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
        $book->load('reviews.user', 'comments.user', 'comments.replies.user', 'shelves');
        $this->book = $book;
    }
    // Валидация, событие на уведомление, addDB - для рецензий
    public function storeReview() {
    
        // dd('STORE REVIEW');
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

        $review = Review::create([
            'user_id' => auth()->id(),
            'book_id' => $this->book->id,
            'rating' => $this->reviewRating,
            'body' => $this->reviewBody,
        ]);

        event(new ReviewCreated($review));

        $this->book->load('reviews.user');
        $this->reset('reviewRating', 'reviewBody');
    }
    // Валидация, событие на уведомление, addDB - для комментарий
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

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'book_id' => $this->book->id,
            'parent_id' => null,
            'body' => $this->commentBody,
        ]);

        event(new CommentCreated($comment));

        $this->book->load('comments.user', 'comments.replies.user');
        $this->reset('commentBody');
    }
    // Валидация, событие на уведомление, addDB - для ответов на комментарий
    public function storeReply(int $parentId) {

        $this->validate([
            'replyBody' => ['required', 'string', 'min:3'],
        ], [
            'replyBody.required' => 'Напишите свой комментарий',
            'replyBody.min' => 'Не короче 3 символов!',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'book_id' => $this->book->id,
            'parent_id' => $parentId,
            'body' => $this->replyBody
        ]);

        event(new CommentCreated($comment));

        $this->reset('replyBody');
        unset($this->replyOpen[$parentId]);
        $this->book->load('comments.user', 'comments.replies.user');

    }
    // скрываем ответы на комментарии если их больше 5
    public function toggleReplies(int $commentId) {
        
        if (isset($this->showAllReplies[$commentId])) {
            unset($this->showAllReplies[$commentId]);
        } 
        else {
            $this->showAllReplies[$commentId] = true;
        }
    }
    // Добавляет книгу на книжную полку текущего пользователя.
    public function addToShelf() {
    
        if (!auth()->check()) return;

        $exists = Shelf::where('user_id', auth()->id())
            ->where('book_id', $this->book->id)
            ->exists();

        if (!$exists) {
            Shelf::create([
                'user_id' => auth()->id(),
                'book_id' => $this->book->id,
                'status' => 'want_to_read',
            ]);
        }

        $this->book->load('shelves');
    }

    public function render()
    {
        return view('livewire.current-book');
    }
}