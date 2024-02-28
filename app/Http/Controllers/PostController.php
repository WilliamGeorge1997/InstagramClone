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
            $followingUserIds = $user->followings()->pluck('followable_id');

            $posts = Post::with(['user.profiles', 'media', 'tags', 'likes'])->whereIn('user_id', $followingUserIds)->get();


            /* $likeController = new LikePostController();
            $likesCounts = [];
            foreach ($posts as $post) {
                $likesCounts[$post->id] = $likeController->getLikesCount($post);
            }
            foreach ($comments as $comment) {
                $likesCounts[$comment->id] = $likeController->getLikesCount($comment);
            }*/
            return view('posts.index', ['posts' => $posts]);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'media' => 'required|array|max:10',
            'media.*' => 'file|mimes:jpeg,jpg,png,gif,mp4|max:20480',
            'tag' => 'nullable|string|max:30|unique:tags',
        ]);
        $post = Post::create([
            "user_id" => $request->userid,
            "caption" => $request->caption,
        ]);
        $tags = explode('#', $request->tag);
        foreach ($tags as $tagItem) {
            $tag = Tag::where('tag', $tagItem)->get();
            if ($tag->isEmpty()) {
                $tag = Tag::create([
                    'tag' => $tagItem
                ]);
            }
            Posts_tag::create([
                'tag_id' => $tag->first()->id,
                'post_id' => $post->id,
            ]);
        }
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
        $posts = Post::with('user', 'media', 'tags')->find($id);
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
            "caption" => $tagCaption==[""] ? null :  $request->tag_caption,
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
    public function tag(Tag $tag)
    {
        $posts = Post::with('user', 'media', 'tags')
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })
            ->get();
        return view('posts.tagPage', [
            'tag' => $tag, 'posts' => $posts
            //  'likesCountData' => $likesCountData
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
