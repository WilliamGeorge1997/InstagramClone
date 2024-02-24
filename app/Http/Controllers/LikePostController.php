<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Overtrue\LaravelLike\Like;

class LikePostController extends Controller
{
    public function likePost($postId)
{

    $authUser = auth()->user();

    $user = User::find($authUser->id);
    $post = Post::find($postId);

    if(!$user->likes()->where('likeable_id', $postId)->exists()) {
        $user->likes()->create([
        'likeable_id' => $postId,
        'likeable_type' => get_class($post)
    ]);
    }

    return redirect()->back();
}

public function unlikePost($postId)
{
    $authUser = auth()->user();
    $user = User::find($authUser->id);

    $user->likes()->where('likeable_id', $postId)->delete();
    return redirect()->back();
}


public function likesCount()
    {

       $posts = Post::all();
       $likesCounts = [];
       foreach($posts as $post){
        $likesCount = Like::all()->where('likeable_id', $post->id)
                                ->where('likeable_type', get_class($post))
                                ->count();
                                $likesCounts[$post->id] = $likesCount;
       }

        return  $likesCounts;
    }
}
