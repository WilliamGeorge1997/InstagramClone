<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts_tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag_id',
        'post_id',
    ];
    public function post(){
        return $this->hasMany(Post::class);
    }

}
