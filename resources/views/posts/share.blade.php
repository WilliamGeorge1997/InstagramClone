@extends('layouts.profile')
@section('title', 'posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')
    {{-- ======================================================================================== --}}
    <div class="d-flex align-items-center  justify-content-center w-100  vh-100 flex-column">

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="post-container  w-100">
                <div class="row row-cols-md-2">
                    {{-- {{ dd( $paths) }} --}}
                    @if ( count($paths) > 1)
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            @foreach ($paths as $key => $medium)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $key }}" {{ $key == 0 ? 'class=active' : '' }}
                                    aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($paths as $key => $medium)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @php
                                        $extension = pathinfo($medium, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ Storage::url($medium) }}" class="d-block post-image w-100"
                                            style="object-fit: cover; max-height: 500px;min-height:300px" alt="...">
                                    @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                                        <video class="d-block post-video w-100"
                                            style="object-fit: cover; max-height: 500px;min-height:300px" autoplay muted
                                            loop>
                                            <source src="{{ Storage::url($medium) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>
                                <input type="hidden" name="param{{ $key }}" value="{{ $medium }}">
                                {{dd($medium)}}
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
                            $extension = pathinfo($paths[0], PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($paths[0]) }}" class="d-block post-image w-100"
                                style="object-fit: cover; max-height: 500px;min-height:300px" alt="...">
                        @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                            <video class="d-block post-video w-100"
                                style="object-fit: cover; max-height: 500px;min-height:300px" autoplay muted loop>
                                <source src="{{ Storage::url($paths[0]) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                    @endif
                    <div>
                        <div class="post-header justify-content-between">
                            <div> <img class="profile-pic"
                                    src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
                                    alt="Profile Picture">
                                <span class="username">
                                    {{ Auth::user()->username }}
                                </span>
                            </div>
                        </div>
                        <div class="my-3">
                            <input type="text" name="tag_caption" class="form-control" id="exampleFormControlInput1"
                                placeholder="Tag and Caption">
                        </div>

                        <button type="submit" class="btn text-primary">Post</button>
                    </div>
                </div>
            </div>
            </from>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
    </div>
@endsection
