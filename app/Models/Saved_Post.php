<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved_Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id'
    ];

    protected $table = "saved_posts";

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
}
