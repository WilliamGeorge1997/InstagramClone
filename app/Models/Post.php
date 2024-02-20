<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caption',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts_media(){
        return $this->hasMany(Post_Media::class);
    }
    public function tag(){
        return $this->hasMany(Tag::class);
    }

    public function like_posts() {
        return $this->hasMany(Like_Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

//!-------- not sure if i need this relationship
    public function saved_posts(){
        return $this->belongsToMany(Saved_Post::class);
    }

}
