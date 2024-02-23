<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Post_Media;
use App\Models\Posts_tag;
use App\Models\Tag;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::find(93);
        // $media = Post_Media::where("post_id",$posts->id)->get();
        $post = Post::with('media','tag')->get();
        $tag = Tag::find($post->tag->first()->tag_id);
        // $post->setAttribute('tags', $tag);
        dd($post);
        return view('posts.index', ['posts' => $post]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255', // Making caption field nullable
                'media' => 'required|array|max:10', // Make sure media is an array with maximum of 10 files
                'media.*' => 'file|mimes:jpeg,jpg,png,gif,mp4|max:20480', // Validate each media file
            'tag' => 'nullable|string|max:30|unique:tags', // Making tag field nullable and correcting the table name to 'tags'
        ]);
        $post = Post::create([
            "user_id" => $request->userid,
            "caption" => $request->caption,
        ]);
        $tag = Tag::where('tag',  $request->tagBody)->get();


        if ($tag->isEmpty()) {
            $tag = Tag::create([
                'tag' => $request->tagBody
            ]);
            $tagId =  $tag->id;
        } else {
            $tagId =  $tag->first()->id;
        }

        Posts_tag::create([
            'tag_id' => $tagId,
            'post_id' => $post->id,
        ]);
        if ($request->file('media')) {
            foreach ($request->file('media') as $image) {
                $path = $image->store('post_media', 'public');
                Post_Media::create([
                    'post_id' => $post->id,
                    'media' => $path
                ]);
            }
        };

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
