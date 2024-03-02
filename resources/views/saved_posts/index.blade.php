@extends('layouts.profile')
@section('title', 'User Profile')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')

    @if (auth()->user()->id == $user->id)
        <p class="mt-3 fw-bolder text-start fs-1 ">Saved posts</p>
        <hr>

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
                                    <source src="{{ Storage::url($savedPost->post->media->first()->media) }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif

                            <div
                                class="position-absolute gap-2 d-flex align-items-center justify-content-center text-white">
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
    @endif

@endsection
