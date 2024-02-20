<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag_id',
        'post_id',
    ];
}
