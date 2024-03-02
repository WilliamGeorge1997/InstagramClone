@extends('layouts.profile')
@section('title', 'Tag Posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
    {{-- ======================================================================================== --}}

    <div class="row align-items-center">
        <div class="col-md-3 col-12">
            <div class="text-center">
                <img src="{{ in_array(pathinfo($posts->first()->media->first()->media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']) ? Storage::url($posts->first()->media->first()->media) : 'https://upload.wikimedia.org/wikipedia/commons/6/63/Number_sign.svg' }}" alt="Tag Picture" class="rounded-circle" style="width: 150px; height: 150px;">
            </div>
        </div>
        <div class="col-md-9  px-5 text-start col-12">
            <p class="fs-5 my-0 "> {{ $tag }} </p>
            <p class="fs-5 my-0">{{ count($posts) }}</p>
            <p class="fs-5 my-0 ">posts</p>
            <button type="submit" class="btn btn-primary col-12 my-3">
                follow
            </button>
        </div>
    </div>

    <hr class="mt-3">
    {{-- <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($posts as $post)
            <div class="col h-50">
                <div class="card ">
                    <img src="{{ Storage::url($post->media->first()->media) }}" class="card-img-top"style="object-fit: cover; height: 300px;" alt="...">
                </div>
            </div>
        @endforeach
</div> --}}
    <div class="row row-cols-xl-3 align-items-center row-cols-md-2 overflow-hidden">
        @foreach ($posts as $post)
        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="m-0 p-1">
            <div class="col">
                <div class="card border-0 position-relative post-disc">
                    @php
                        $extension = pathinfo($post->media->first()->media, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ Storage::url($post->media->first()->media) }}"
                            class="d-block post-image w-100"
                            style="object-fit: cover;height:300px" alt="...">
                    @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                        <video class="d-block post-image w-100"
                            style="object-fit: cover; height:300px">
                            <source src="{{ Storage::url($post->media->first()->media) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif

                    <div
                        class="position-absolute gap-2 d-flex align-items-center justify-content-center text-white">
                        <div><i class="
                           @if ($post->media->count() > 1)
                           fa-images fa-regular
                           @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                           fa-solid fa-clapperboard
                           @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            fa-regular
                              fa-image
                           @endif
                           "
                                style=" top: 5%; right: 5%;position:absolute;"></i></div>
                        <div>
                            <i class="fa-solid fa-heart m-2"></i><span>{{ $post->likes->count() }}</span>
                            <i class="fa-solid fa-comment ms-3 me-1"></i><span>{{$post->comments ?count($post->comments):0 }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </a>
    @endforeach
</div> @endsection
