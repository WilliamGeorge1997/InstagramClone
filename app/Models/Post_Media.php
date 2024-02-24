<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Media extends Model
{
    use HasFactory;
    protected $table = 'posts_media';
    protected $fillable = [
        'post_id',
        'media',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
