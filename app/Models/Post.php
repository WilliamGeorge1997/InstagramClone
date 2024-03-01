<?php

namespace App\Models;

use Overtrue\LaravelLike\Like;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'user_id',
        'caption',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(Post_Media::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function saved_posts()
    {
        return $this->belongsToMany(Saved_Post::class);
    }
}
