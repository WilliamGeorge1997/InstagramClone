@extends('layouts.profile')
@section('title', 'Share Post')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')
    {{-- ======================================================================================== --}}
    <div class="d-flex p-4 align-items-center justify-content-center w-100  vh-100 ">
        <form action="{{ route('posts.store') }}" method="POST" class="row row-cols-md-2 vh-100 w-100">
            @csrf
            <div class="col-md-7">

                @if (count($paths) > 1)
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
                                    @if (in_array(pathinfo($medium, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ Storage::url($medium) }}" class=" d-block post-image w-100"
                                            style="object-fit: cover;height:600px" alt="...">
                                    @elseif (in_array(pathinfo($medium, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'wmv']))
                                        <video class="d-block post-video w-100" style="object-fit: cover; height:600px"
                                            autoplay muted loop>
                                            <source src="{{ Storage::url($medium) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                                <input type="hidden" name="param{{ $key }}" value="{{ $medium }}">
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
                        @if (in_array(pathinfo($paths[0], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'wepb']))
                            <img src="{{ Storage::url($paths[0]) }}" class="d-block post-image w-100"
                                style="object-fit: cover;height:600px" alt="...">
                        @elseif (in_array(pathinfo($paths[0], PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'wmv']))
                            <video class="d-block post-video w-100"
                             style="object-fit: cover; height:600px" autoplay muted
                                loop>
                                <source src="{{ Storage::url($paths[0]) }}" type="video/mp4">
                            </video>
                        @endif
                        <input type="hidden" name="param0" value="{{ $paths[0] }}">
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                <div class="post-header justify-content-between">
                    <div> <img class="profile-pic"
                            src="{{ $user->profiles->avatar? Storage::url($user->profiles->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                            alt="Profile Picture">
                        <span class="username">
                            {{ Auth::user()->username }}
                        </span>
                    </div>
                </div>
                <div class="mt-2">
                    <textarea name="tag_caption" class="form-control" id="exampleFormControlTextarea1" placeholder="caption" rows="3"></textarea>
                    <button type="submit" class="btn text-primary">Post</button>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif
            </div>

        </from>
    </div>
@endsection
