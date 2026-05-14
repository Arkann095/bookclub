<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Review;
use App\Models\Comment;

#[Fillable(['name', 'email', 'password', 'avatar', 'bio', 'is_private'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin'=>'boolean'
        ];
    }

    public function reviews() {

        return $this->hasMany(Review::class);

    }

    public function comments() {

        return $this->hasMany(Comment::class);

    }

    public function followers() {

        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
        
    }

    public function following() {

        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');

    }
}
