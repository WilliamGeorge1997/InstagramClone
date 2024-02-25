@extends('layouts.main')
@section('title', 'posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')

    {{-- ======================================================================================== --}}
    <div class="post-container  w-100">

        <div class="row row-cols-md-2">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($post->media as $medium)
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $medium->media) }}" class="d-block mt-2 post-image"
                                alt="...">
                        </div>
                    @endforeach
                </div>
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
               <form action="{{ route('posts.update', ['post' => $post->id])}}" method="POST" >
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" name="tag" class="form-control" id="exampleFormControlInput1"
                   value='@foreach($post->tags as $tagBody) #{{$tagBody->tag }}@endforeach'
                     placeholder="tag">
                  </div>
                  <div class="mb-3">
                    <textarea  name="caption" class="form-control"
                    value="{{ $post->caption }}"

                       id="exampleFormControlTextarea1"  placeholder="caption" rows="3">{{ $post->caption }}</textarea>
                  </div>
                    <button type="submit" class="btn text-primary">Edit</button>
                 </from>
                 @if ($errors->any() )
                 @foreach($errors->all() as $error)
                 <p>{{$error}}</p>
                 @endforeach
                     @endif
                </div>

            </div>
        </div>


@endsection
