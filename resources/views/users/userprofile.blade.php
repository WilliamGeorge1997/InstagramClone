 @extends('layouts.profile')
 @section('title','User Profile')
 @section('style')
 <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
 <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
 @section('content')

     <section class=" row mt-5 flex-nowrap">
         <!-- Profile Picture -->
         <div class="col-md-4">
            <img src="{{ $profileInfo->first()->avatar ? Storage::url($profileInfo->first()->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
            alt="Profile Picture" class="rounded-circle" style=" width: 150px; height: 150px;">
         </div>
         <div class="col-md-8">
             <div class="d-flex  align-items-center">
                 <!-- Username -->
                 <span class="fs-4 me-4 text-start">{{ $user->username }}</span>
                 {{-- !Follow/Unfollow button --}}
                 @if (auth()->check() && auth()->user()->id !== $user->id)
                     @if (auth()->user()->isFollowing($user))
                         {{-- Unfollow button --}}
                         <form action="{{ route('users.unfollow', $user->id) }}" method="post" class="d-inline mx-3">
                             @csrf
                             @method('delete')
                             <button type="submit" class="btn btn-danger">Unfollow</button>
                         </form>
                     @else
                         {{-- ! Follow/Follow Back button --}}
                         <form action="{{ route('users.follow', $user->id) }}" method="post" class="d-inline">
                             @csrf
                             @if ($user->isFollowing(auth()->user()))
                                 <button type="submit" class="btn btn-success ">Follow Back</button>
                             @else
                                 <button type="submit" class="btn btn-primary ">Follow</button>
                             @endif
                         </form>
                     @endif
                 @endif
                 {{-- !Edit Profile Button --}}
                 @if (Auth::check() && $user->id == Auth::user()->id)
                     <!-- Edit Profile Button -->
                     <a href=" {{ route('users.edit', $user->id) }}"><button class=" mx-3 btn btn-primary">
                             Edit Profile</button></a>
                 @endif
                 {{-- !Block/Unblock button --}}
                 @if (Auth::check() && $user->id !== Auth::user()->id)
                     <form method="POST" action="{{ route('users.block', $user->id) }}" class="mx-3">
                         @csrf
                         {{-- @if (auth()->user()->isBlockedBy($user))
                                         <button type="submit" class="btn btn-danger">Unblock</button>
                                     @else --}}
                         <button type="submit" class="btn btn-danger px-4">Block</button>
                         {{-- @endif --}}
                     </form>
                 @endif
                 {{-- !displaying blocked users button  --}}
                 @if (Auth::check() && $user->id == Auth::user()->id)
                     <a href="{{ route('users.blocked', $user->id) }}"><button class="mx-3 btn btn-primary">Blocked
                             Users</button></a>
                 @endif
             </div>
             {{-- ! Posts, Followers, Following count --}}
             <div class="d-flex mt-3 ">
                 <!-- Posts -->
                 <p class="me-4 text-start">{{ count($posts) }} <strong>Posts</strong> </p>
                 <!-- Followers, Following, Posts -->
                 <!-- Followers -->
                 <p class="mx-4 ms-2 text-start"> {{ $followCountData['followersCount'] }} <strong><a
                             class="text-decoration-none text-muted" href="{{ route('users.followers', $user->id) }}">
                             Followers
                         </a></strong></p>
                 <!-- Following -->
                 <p class="mx-4 ms-2 text-start"> {{ $followCountData['followingCount'] }} <strong><a
                             class="text-decoration-none text-muted" href="{{ route('users.followings', $user->id) }}">
                             Following
                         </a></strong></p>
             </div>

             {{-- ! Bio  --}}
             <div>
                 <p class="m-0 text-start"> {{ $profileInfo->first()->bio ? $profileInfo->first()->bio : '' }} </p>
                 <p class="m-0 text-start">{{ $profileInfo->first()->website ? $profileInfo->first()->website : '' }}</p>
                 <p class="m-0 text-start">{{ $profileInfo->first()->gender ? $profileInfo->first()->gender : '' }}</p>
             </div>
         </div>
         </div>
     </section>
     <hr class="mt-3">

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
