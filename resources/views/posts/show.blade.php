@extends('layouts.profile')
@section('title', 'Show Post')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')

    {{-- ======================================================================================== --}}
    <div class="w-100 p-4 d-flex  justify-content-center vh-100">
        <div class="row vh-100 w-100 ">
            <div class="col-md-7 align-items-center">
                @if ($post->media->count() > 1)
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            @foreach ($post->media as $key => $medium)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $key }}" {{ $key == 0 ? 'class=active' : '' }}
                                    aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($post->media as $key => $medium)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @php
                                        $extension = pathinfo($medium->media, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ Storage::url($medium->media) }}" class="d-block post-image w-100"
                                            style="object-fit: cover; height: 600px;" alt="...">
                                    @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                                        <video class="d-block post-video w-100" style="object-fit: cover;height: 600px;"
                                            autoplay muted loop>
                                            <source src="{{ Storage::url($medium->media) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div>
                        @php
                            $extension = pathinfo($post->media->first()->media, PATHINFO_EXTENSION);

                        @endphp
                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($post->media->first()->media) }}" class="d-block post-image w-100"
                                style="object-fit: cover;height:600px" alt="...">
                        @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                            <video class="d-block post-video w-100" style="object-fit: cover; height:600px" autoplay muted
                                loop>
                                <source src="{{ Storage::url($post->media->first()->media) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                <div class="post-header justify-content-between">
                    <div>
                        <a href="{{ route('users.show', $post->user->id) }}"class="text-decoration-none text-black">
                            <img loading="lazy" class="profile-pic"
                                src="{{ $post->user->profiles->avatar ? Storage::url($post->user->profiles->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                                alt="Profile Picture">
                            <span class="username">{{ $post->user->username }}</span>
                        </a>
                    </div>
                    @if ($post->user->id === Auth::user()->id)
                        <div class="btn-group">
                            <i type="button" class="fa-solid fa-ellipsis-vertical dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">

                            </i>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="dropdown-item">
                                        <i class="fa-regular fa-pen-to-square text-black text-decoration-none"></i></a></li>

                                <li>
                                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post"
                                        class="dropdown-item">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 p-0" style="background:none;">
                                            <i
                                                class="fa-regular fa-solid fa-trash fa-pen-to-square text-danger text-decoration-none"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="post-caption">
                    @php
                        $tagCaption = explode(' ', $post->caption);
                        $j = 0;
                    @endphp
                    @foreach ($tagCaption as $word)
                        @if (Str::startsWith($word, '#'))
                            <a href="{{ route('posts.tag', ['tag' => $post->tags[$j]->id]) }}">{{ $word }}</a>
                            @php
                                $j++;
                            @endphp
                        @else
                            {{ $word }}
                        @endif
                    @endforeach
                </div>
                <div class="likes-comments">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            @auth
                                @if (auth()->user()->hasLiked($post))
                                    {{-- User has liked the post, show unlike button --}}
                                    <form action="{{ route('posts.unlike', ['post' => $post->id]) }}" method="post"
                                        id="unlikeForm_{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 p-0" style="background:none;">
                                            <span class="like-btn">
                                                <svg aria-label="Like" class="x1lliihq x1n2onr6 xyb1xck" fill="#ed4956"
                                                    height="24" role="img" loading="lazy" viewBox="0 0 24 24"
                                                    width="24">
                                                    <title>Like</title>
                                                    <!-- Outer heart border -->
                                                    <path
                                                        d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                                                    </path>
                                                    <!-- Inner heart fill -->
                                                    <path fill="#ed4956"
                                                        d="M12 21.35l-1.45-1.32C5.55 15.36 2 12.28 2 9.5 2 6.42 4.42 4 7.5 4c1.74 0 3.41.81 4.5 2.09C14.09 4.81 15.76 4 17.5 4 20.58 4 23 6.42 23 9.5c0 2.78-3.55 5.86-8.55 10.54L12 21.35z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                @else
                                    {{-- User hasn't liked the post, show like button --}}
                                    <form action="{{ route('posts.like', ['post' => $post->id]) }}" method="post"
                                        id="likeForm_{{ $post->id }}">
                                        @csrf
                                        <button type="submit" class="border-0 p-0" style="background:none;">
                                            <span class="like-btn"><svg aria-label="Like" class="x1lliihq x1n2onr6 xyb1xck"
                                                    fill="currentColor" height="24" role="img" loading="lazy"
                                                    viewBox="0 0 24 24" width="24">
                                                    <title>Like</title>
                                                    <path
                                                        d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </button>

                                    </form>
                                @endif
                            @endauth

                            <label for="comment"> <span class="comment-btn"><svg aria-label="Comment"
                                        class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24"
                                        role="img" viewBox="0 0 24 24" width="24">

                                        <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none"
                                            stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg></span>
                            </label>
                        </div>
                        <!-- -------------------Save post section-------------------- -->
                        @auth
                            @if (auth()->user()->hasSaved($post->id))
                                <!--  --------- Check if the post has been saved before , show unsave button ----------- -->
                                <form action="{{ route('saved-posts.destroy', $post->id) }}" method="post"
                                    id="unsaveForm{{ $post->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 p-0" style="background:none;">
                                        <span class="save-btn">
                                            <svg aria-label="Save" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor"
                                                height="24" role="img" viewBox="0 0 24 24" width="24">
                                                <title>Unsave</title>
                                                <polygon fill="#000" points="20 21 12 13.44 4 21 4 3 20 3 20 21"
                                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"></polygon>
                                            </svg>
                                        </span>
                                    </button>

                                </form>
                            @else
                                <!--  --------- The user has not save the post before , show save button ----------- -->
                                <form action="{{ route('saved.posts.store', ['id' => $post->id]) }}" method="post"
                                    id="saveForm{{ $post->id }}" class="mb-0">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    @csrf

                                    <button type="submit" class="border-0 p-0" style="background:none;">
                                        <span class="save-btn">
                                            <svg aria-label="Save" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor"
                                                height="24" role="img" viewBox="0 0 24 24" width="24">
                                                <title>Save</title>
                                                <polygon fill="none" points="20 21 12 13.44 4 21 4 3 20 3 20 21"
                                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"></polygon>
                                            </svg>
                                        </span>
                                    </button>

                                </form>
                            @endif
                        @endauth
                        <!-- -------------------The End Save post section-------------------- -->

                    </div>
                </div>
                <div class="likes fw-bold">
                    <span>
                        {{ $post->likes->count() }} @if ($post->likes->count() == 1)
                            Like
                        @else
                            Likes
                        @endif
                    </span>
                </div>


                <!--  --------------------- ---The comment section-------------------------------------  -->
                <div class="comments m-0" style="max-height: 300px; overflow-y: auto;">
                    @foreach ($comments as $comment)
                        <div class="container mt-3">
                            <ul class="list-unstyled">
                                <li class="d-flex flex-column ">
                                    <div class="d-flex align-items-center">
                                        <!-- --------------profile picture--------------- -->
                                        <div class="me-2 p-0">
                                            <img src="{{ $comment->users->profiles->avatar ? Storage::url($comment->users->profiles->avatar) : url('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png') }}"
                                                alt="Profile Picture" class="img-fluid rounded-circle"
                                                style="width: 25px; height: 25px;">
                                        </div>
                                        <!-- ------------------------Username---------------------- -->
                                        <h6 class="mb-0">
                                            <a class="text-black text-decoration-none"
                                                href="{{ route('users.show', ['user' => $comment->user_id]) }}">{{ $comment->users->username }}</a>
                                        </h6>
                                    </div>

                                    <!-- ----------------------The comment body----------------------------- -->

                                    <p class="mb-0 text-start">{{ $comment->body }}</p>


                                    <div class="d-flex align-items-center justify-content-between">

                                        <small class="text-muted ">{{ $comment->timeAgo }}</small>

                                        <!-- ---------------------Delete comment-------------------------------- -->

                                        <form method="POST" action="{{ route('posts.comment.destroy', $comment->id) }}"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn d-flex align-items-center btn-sm text-danger p-0">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>


                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
                <!-- ---------------------Store comment-------------------------------- -->
                <form action="{{ route('posts.comment.store', $post->id) }}" method="POST"
                    class="d-flex border-bottom">
                    @csrf
                    <textarea name="body" placeholder="Add a comment..." class="comment bg-transparent p-1" id="comment"
                        cols="1" rows="1"></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="btn text-primary" type="submit">Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
