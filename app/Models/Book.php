<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\Review;
use App\Models\Comment;

#[Fillable(['title', 'author', 'description', 'cover_image', 'published_year', 'isbn'])]
class Book extends Model
{
    use HasFactory; 
    public function reviews() {

        return $this->hasMany(Review::class);

    }

    public function comments() {

        return $this->hasMany(Comment::class);

    }
}
