<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Review;
use App\Models\Comment;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'description', 'cover_image', 'book_file','published_year', 'isbn', 'user_id'];

    use HasFactory; 

    public function user() {
    
        return $this->belongsTo(User::class);

    }

    public function reviews() {

        return $this->hasMany(Review::class);

    }

    public function comments() {

        return $this->hasMany(Comment::class);

    }

    public function shelves() { 

        return $this->hasMany(Shelf::class);

    }
}
