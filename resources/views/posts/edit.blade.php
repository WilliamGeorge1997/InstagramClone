@extends('layouts.profile')
@section('title', 'Edit Posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')

    {{-- ======================================================================================== --}}
    <div class="w-100 p-4 d-flex align-items-center justify-content-center vh-100">
        <div class="row  vh-100 w-100">
            <div class="col-md-7">
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
                                            style="object-fit: cover;height:600px" alt="...">
                                    @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                                        <video class="d-block post-video w-100" style="object-fit: cover;height:600px"
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
                                style="object-fit: cover; height: 600px;" alt="...">
                        @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                            <video class="d-block post-video w-100" style="object-fit: cover; height: 600px;" autoplay muted
                                loop>
                                <source src="{{ Storage::url($post->media->first()->media) }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                <div class="post-header justify-content-between">
                    <div> <img class="profile-pic"
                        src="{{ $post->user->profiles->avatar? Storage::url($post->user->profiles->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                        alt="Profile Picture">
                        <span class="username">
                            {{ $post->user->username }}
                        </span>
                    </div>
                </div>
                <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <textarea name="tag_caption" class="form-control" value="{{ $post->caption }}" id="exampleFormControlTextarea1"
                        placeholder="caption" rows="3">{{ $post->caption }}</textarea>
                    <button type="submit" class="btn text-primary">Edit</button>
                    </from>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
@endsection
