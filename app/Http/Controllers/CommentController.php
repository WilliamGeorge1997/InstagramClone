<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'body' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        Comment::find($id)->delete();
        return redirect()->back();
    }
}
