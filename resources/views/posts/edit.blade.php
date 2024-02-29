@extends('layouts.profile')
@section('title', 'Edit Posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')

    {{-- ======================================================================================== --}}
    <div class="w-100 p-4 d-flex align-items-center justify-content-center vh-100">

        <div class="row row-cols-md-2">
            <div>
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
                                        style="object-fit: cover; max-height: 500px;min-height:300px" alt="...">
                                @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                                    <video class="d-block post-video w-100"
                                        style="object-fit: cover; max-height: 500px;min-height:300px" autoplay muted loop>
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
                            style="object-fit: cover; max-height: 500px;min-height:300px" alt="...">
                    @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                        <video class="d-block post-video w-100"
                            style="object-fit: cover; max-height: 500px;min-height:300px" autoplay muted loop>
                            <source src="{{ Storage::url($post->media->first()->media) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
                @endif
            </div>

            <div>
                <div class="post-header justify-content-between">
                    <div> <img class="profile-pic"
                            src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
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
