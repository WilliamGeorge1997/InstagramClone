<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelFollow\Traits\Follower;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelLike\Traits\Liker;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Follower, Followable, Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'username',
        'fullname',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function like_comments()
    {
        return $this->hasMany(Like_Comment::class);
    }

    public function like_posts()
    {
        return $this->hasMany(Like_Post::class);
    }

    public function follow_status()
    {
        return $this->hasMany(Follow_Status::class);
    }

    // public function blocks()
    // {
    //     return $this->hasMany(Block::class);
    // }

    public function blocks()
    {
        return $this->belongsToMany(User::class, 'blocks', 'blocked_id', 'blocker_id')->withTimestamps();
    }

    public function isBlockedBy(User $user)
    {
        return $this->blocks()->where('blocker_id', $user->id)->exists();
    }


    public function saved_posts()
    {
        return $this->hasMany(Saved_Post::class);
    }
}
