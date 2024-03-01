<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'body'
    ];

    public function users()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    public function like_comments()
    {
        return $this->hasMany(Like_Comment::class);
    }

    public function getTimeAgoAttribute()
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        return $createdAt->diffForHumans();
    }
}
