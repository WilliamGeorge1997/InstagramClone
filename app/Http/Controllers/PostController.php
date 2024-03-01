<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Posts_tag;
use App\Models\Post_Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Overtrue\LaravelLike\Like;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $authUser = auth()->user();
         $user = User::find($authUser->id);
        $posts = Post::with(['user.profiles', 'media', 'tags', 'likes'])
        ->where(function ($query) use ($user) {
        $query->whereIn('user_id', $user->followings()->pluck('followable_id'))
              ->orWhere('user_id', $user->id);
    })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('posts.index', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }
    public function share(Request $request)
    {
        $paths = $request->session()->get('paths', []);

        $request->validate([
            'media' => 'required|array|max:10',
            'media.*' => 'file|mimes:jpeg,jpg,png,gif,mp4|max:90480',
        ]);
        $paths = [];
        if ($request->file('media')) {
            foreach ($request->file('media') as $image) {
                $paths[] = $image->store('post_media', 'public');
            }
        };
        $request->session()->put('paths', $paths);

        return view('posts.share', ['paths' => $paths]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag_caption' => 'nullable|string',

        ]);
        $tagCaption = explode(' ', $request->tag_caption);

        $post = Post::create([
            "user_id" =>  auth()->user()->id,
            "caption" => $tagCaption == [""] ? null :  $request->tag_caption,
        ]);

        foreach ($tagCaption as $item) {
            if (Str::startsWith($item, '#')) {
                $tagModel = Tag::firstOrCreate(['tag' => $item]);
                $post->tags()->attach($tagModel->id);
            }
        }
        foreach ($request->input() as $key => $value) {
            if (strpos($key, 'param') === 0) {
                Post_Media::create([
                    'post_id' => $post->id,
                    'media' => $value,
                ]);
            }
        }
        return redirect()->route('posts.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::with('user', 'media', 'tags', 'likes')->find($id);
        return view('posts.show', ['post' => $posts]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = Post::with('user', 'media', 'tags')->find($id);
        return view('posts.edit', ['post' => $posts]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Posts_tag::where('post_id', $post->id)->delete();
        $request->validate([
            'tag_caption' => 'nullable|string',
        ]);
        $tagCaption = explode(' ', $request->tag_caption);

        foreach ($tagCaption as $item) {
            if (Str::startsWith($item, '#')) {
                $tagModel = Tag::firstOrCreate(['tag' => $item]);
                $post->tags()->syncWithoutDetaching([$tagModel->id]);
            }
        }
        $post->update([
            "caption" => $tagCaption == [""] ? null :  $request->tag_caption,
        ]);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function tag(string $id)
    {

        $posts = Post::with('user', 'media', 'tags','likes')
            ->whereHas('tags', function ($query) use ($id) {
                $query->where('tags.id', $id);
            })->orderBy('created_at', 'desc')
            ->get();
        $tag = Tag::find($id)->tag;
        return view('posts.tagPage', [
            'tag' => $tag, 'posts' => $posts
        ]);
    }

    public function postsByUserId(string $id)
    {
        $posts = Post::with('user', 'media', 'tags')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $posts = Post::with('user', 'media', 'tags')
            ->where('user_id', $id)
            ->orderBy('timestamp', 'desc') // Assuming 'timestamp' is the name of the attribute
            ->get();
        return view('posts.profile', [
            'posts' => $posts
        ]);
    }
}
