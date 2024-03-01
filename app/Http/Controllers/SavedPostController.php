<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Saved_Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $savedPosts = $user->saved_posts()->with('post.comments.users')->get();
        return view('saved_posts.index', compact('savedPosts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $user = Auth::user();
        
        if ($user->saved_posts()->where('post_id', $request->post_id)->exists()) {
            // The user has already saved the post
            return redirect()->back()->with('error', 'You have already saved this post.');
        } else {
            // The user has not saved the post before, proceed with saving it
            $savedPost = new Saved_Post();
            $savedPost->user_id = $request->user_id;
            $savedPost->post_id = $request->post_id;
            $savedPost->save();
            return redirect()->back()->with('success', 'Post saved successfully.');
        }
    }

    public function destroy(string $postId)
    {
        $user = Auth::user();
        $savedPosts = $user->saved_posts()->where('post_id', $postId)->get();

        foreach ($savedPosts as $savedPost) {
            
            $savedPost->delete();
        }
        return redirect()->back()->with('success', 'All saved posts removed for this post!');
    }
    }

