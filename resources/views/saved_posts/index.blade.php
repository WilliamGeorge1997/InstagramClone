@extends('layouts.profile')
@section('title', 'User Profile')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')

    <section class=" row mt-5 flex-nowrap">
        <!-- Profile Picture -->
        <div class="col-md-4">
            <img src="{{ $user->profiles->avatar ? Storage::url($user->profiles->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                alt="Profile Picture" class="rounded-circle" style=" width: 100px; height: 100px;">
            <span class="fs-4 ms-4 text-start">{{ $user->username }}</span>

        </div>

    </section>
    <hr class="mt-3">

     <div class="container text-center mt-1">
        <a href="{{ route('posts.saved-posts') }}" style="text-decoration: none; color: black;">
            <span class="save-btn">
                <svg aria-label="Save" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img"
                    viewBox="0 0 24 24" width="24">
                    <title>Saved</title>
                    <polygon fill="none" points="20 21 12 13.44 4 21 4 3 20 3 20 21" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon>
                </svg>
            </span>
            Save Posts
        </a>

        <a href="{{ route('users.show', auth()->id()) }}" class="ms-3" style="text-decoration: none; color: black;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                <rect fill="none" height="18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" width="18" x="3" y="3"></rect>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    x1="9.015" x2="9.015" y1="3" y2="21"></line>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    x1="14.985" x2="14.985" y1="3" y2="21"></line>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    x1="21" x2="3" y1="9.015" y2="9.015"></line>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" x1="21" x2="3" y1="14.985" y2="14.985"></line>
            </svg> Posts
        </a>
        <hr class="mt-3 w-50 mx-auto w-50">
    </div>

    <div class="row row-cols-xl-3 align-items-center row-cols-md-2 overflow-hidden">
        @foreach ($savedPosts as $savedPost)
            <a href="{{ route('posts.show', ['post' => $savedPost->post->id]) }}" class="m-0 p-1">
                <div class="col ">
                    <div class="card border-0 position-relative post-disc ">
                        @php
                            $extension = pathinfo($savedPost->post->media->first()->media, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($savedPost->post->media->first()->media) }}"
                                class="d-block post-image w-100" style="object-fit: cover;height:300px" alt="...">
                        @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                            <video class="d-block post-image w-100" style="object-fit: cover; height:300px">
                                <source src="{{ Storage::url($savedPost->post->media->first()->media) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                        <div class="position-absolute gap-2 d-flex align-items-center justify-content-center text-white">
                            <div><i class="
                                   @if ($savedPost->post->media->count() > 1) fa-images fa-regular
                                   @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                                   fa-solid fa-clapperboard
                                   @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    fa-regular
                                      fa-image @endif
                                   "
                                    style=" top: 5%; right: 5%;position:absolute;"></i></div>
                            <div>
                                <i class="fa-solid fa-heart me-1"></i><span>{{ $savedPost->post->likes->count() }}</span>
                                <i class="fa-solid fa-comment ms-3 me-1"></i><span>{{$savedPost->post->comments ?count($savedPost->post->comments):0 }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </a>
        @endforeach
    </div>
@endsection
