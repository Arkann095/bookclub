<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Book;

class Shelf extends Model
{
    protected $fillable = ['user_id', 'book_id', 'status', 'started_at', 'finished_at'];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }

    public function book() {
    
        return $this->belongsTo(Book::class);

    }
    
}
