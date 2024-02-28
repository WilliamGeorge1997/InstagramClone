 @extends('layouts.profile')
 @section('title', 'posts')
 @section('style')
     <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
     <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
 @endsection
 @section('content')
     <div class=" mt-5 mx-auto">
         <div class="row align-items-center">
             <div class="col-md-3">
                 <!-- Profile Picture -->
                 <div class="text-center">
                     <img src="{{ isset($profileInfo->first()->avatar) ? asset('storage/' . $profileInfo->first()->avatar) : asset('storage/default-avatar.png') }}"
                         alt="Profile Picture" class="rounded-circle" style=" width: 150px; height: 150px;">
                 </div>
             </div>
             <div class="col-md-9">
                 <!-- Username -->
                 <section class="d-flex flex-column mb-3">
                     <div class="row align-items-center">
                         <span class="fs-4 col-4">{{ $user->username }}</span>
                         <!-- Edit Profile Button -->
                         {{-- Follow/Unfollow button --}}

                         @if (auth()->check() && auth()->user()->id !== $user->id)
                             @if (auth()->user()->isFollowing($user))
                                 {{-- Unfollow button --}}
                                 <form action="{{ route('users.unfollow', $user->id) }}" method="post" class="d-inline">
                                     @csrf
                                     @method('delete')
                                     <button type="submit" class="btn btn-danger col-2">Unfollow</button>
                                 </form>
                             @else
                                 {{-- Follow/Follow Back button --}}
                                 <form action="{{ route('users.follow', $user->id) }}" method="post" class="d-inline">
                                     @csrf

                                     @if ($user->isFollowing(auth()->user()))
                                         <button type="submit" class="btn btn-success col-2">Follow Back</button>
                                     @else
                                         <button type="submit" class="btn btn-primary col-2">Follow</button>
                                     @endif

                                 </form>
                             @endif
                         @endif

                         <a href=" {{ route('users.edit', $user->id) }}" class="btn btn-primary col-2">Edit
                             Profile</a>
                     </div>
                     <div class="row mt-3">
                         <div class="col">
                             <!-- Posts -->
                             <p>{{ count($posts) }} <strong>Posts</strong> </p>
                         </div>
                         <!-- Followers, Following, Posts -->
                         <div class="col">
                             <!-- Followers -->
                             <p><strong><a class="text-decoration-none text-muted"
                                         href="{{ route('users.followers', $user->id) }}">Followers:
                                         {{ $followCountData['followersCount'] }}</a></strong></p>
                         </div>
                         <div class="col">
                             <!-- Following -->
                             <p><strong><a class="text-decoration-none text-muted"
                                         href="{{ route('users.followings', $user->id) }}">Following:
                                         {{ $followCountData['followingCount'] }}</a></strong></p>
                         </div>
                     </div>
                 </section>
                 <!-- Bio -->
                 <p class="m-0 text-start"> {{ $profileInfo->first()->bio ? $profileInfo->first()->bio : '' }} </p>
                 <p class="m-0 text-start">{{ $profileInfo->first()->website ? $profileInfo->first()->website : '' }}</p>
                 <p class="m-0 text-start">{{ $profileInfo->first()->gender ? $profileInfo->first()->gender : '' }}</p>
             </div>
             <hr class="mt-3">

         </div>
         <hr class="mt-3">
     </div>

     @if (count($posts) == 0)
         <div class="d-flex justify-content-center align-items-center w-100 h-100">
             @if (auth()->user()->id == $user->id)
                 <div
                     class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x6s0dn4 x1oa3qoh x1nhvcw1">
                     <div class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xvkph5b x1dtbblo x7i73kt x14n70j1 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x6s0dn4 x1oa3qoh x1nhvcw1"
                         style="max-width: 350px;">
                         <div class="iconaia p-3"> <a href="{{ route('posts.create') }}"> <i
                                     class="fa-solid fa-camera fs-1 text-black"></i></a>
                         </div>
                         <div
                             class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xqui205 x1hq5gj4 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1">
                             <span class="fw-bolder fs-1">Share
                                 Photos</span>
                         </div>
                         <div
                             class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh x1hq5gj4 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1">
                             <span>When
                                 you share photos, they will appear on your profile.</span>
                         </div>
                         <a href="{{ route('posts.create') }}" class="text-decoration-none">
                             <div class="x1i10hfl xjqpnuy xa49m3k xqeqjp1 x2hbi6w xdl72j9 x2lah0s xe8uvvx xdj266r x11i5rnm xat24cr x1mh8g0r x2lwn1j xeuugli x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1q0g3np x1lku1pv x1a2a7pz x6s0dn4 xjyslct x1ejq31n xd10rxx x1sy0etr x17r0tee x9f619 x1ypdohk x1f6kntn xwhw2v2 xl56j7k x17ydfre x2b8uid xlyipyv x87ps6o x14atkfc xcdnw81 x1i0vuye xjbqb8w xm3z3ea x1x8b98j x131883w x16mih1h x972fbf xcfux6l x1qhh985 xm0m39n xt7dq6l xexx8yu x4uap5 x18d9i69 xkhd6sd x1n2onr6 x1n5bzlp x173jzuc x1yc6y37 x3nfvp2"
                                 role="button" tabindex="0">Share your first photo</div>
                         </a>
                     </div>
                 </div>
             @else<div
                     class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x6s0dn4 x1oa3qoh x1nhvcw1">
                     <div
                         class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xvkph5b x7i73kt x14n70j1 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x6s0dn4 x1oa3qoh x1nhvcw1">
                         <div class="_ab5c _ab5d _ab5i" style="height: 62px; width: 62px;"><span aria-label="Camera"
                                 class="_9-z- _aa5a"></span></div>
                         <div
                             class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xg87l8a x13ihpsm x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1">
                             <span class="fw-bolder fs-1">No
                                 Posts Yet</span>
                         </div>
                     </div>
                 </div>
             @endif
         </div>
     @else
         <div class="row row-cols-xl-3 align-items-center row-cols-md-2 overflow-hidden">
             @foreach ($posts as $post)
                 <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="m-0 p-1">
                     <div class="col ">
                         <div class="card border-0 position-relative post-disc ">
                             @php
                                 $extension = pathinfo($post->media->first()->media, PATHINFO_EXTENSION);
                             @endphp
                             @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                 <img src="{{ Storage::url($post->media->first()->media) }}"
                                     class="d-block post-image w-100"
                                     style="object-fit: cover;height:300px" alt="...">
                             @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                                 <video class="d-block post-image w-100"
                                     style="object-fit: cover; height:300px" >
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
                                     <i class="fa-solid fa-heart m-2"></i><span>344</span>
                                     <i class="fa-solid fa-comment m-2"></i><span>677</span>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </a>
             @endforeach
         </div>
     @endif
 @endsection
