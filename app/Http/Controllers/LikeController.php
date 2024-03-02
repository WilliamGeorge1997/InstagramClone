<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Overtrue\LaravelLike\Like;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function likePost(string $postId)
{

    $authUser = auth()->user();

    $user = User::find($authUser->id);
    $post = Post::find($postId);


    if(!$user->likes()->where('likeable_id', $postId)->exists()) {
        $user->likes()->create([
        'likeable_id' => $postId,
        'likeable_type' => get_class($post),
    ]);
    }

    return redirect()->back();
}

public function unlikePost(string $postId)
{
    $authUser = auth()->user();
    $user = User::find($authUser->id);

    $user->likes()->where('likeable_id', $postId)->delete();
    return redirect()->back();
}


public function getLikesCount($model)
    {
        $likesCount = DB::table('likes')
            ->where('likeable_id', $model->id)
            ->where('likeable_type', get_class($model))
            ->count();

        return $likesCount;
    }

    /* Comment Likes*/
    public function likeComment($commentId)
{

    $authUser = auth()->user();
    $user = User::find($authUser->id);
    $comment = Comment::find($commentId);

    if (!$user->likes()->where('likeable_id', $commentId)->exists()) {
        $user->likes()->create([
            'likeable_id' => $commentId,
            'likeable_type' => get_class($comment),
        ]);
    }

    return redirect()->back();
}

public function unlikeComment($commentId)
{
    $authUser = auth()->user();
    $user = User::find($authUser->id);

    $user->likes()->where('likeable_id', $commentId)->delete();

    return redirect()->back();
}
}
