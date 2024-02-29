 @extends('layouts.profile')
 @section('content')

     <section class=" row mt-5 flex-nowrap">
         <!-- Profile Picture -->
         <div class="col-md-4">
             <img src="{{ isset($profileInfo->first()->avatar) ? asset('storage/' . $profileInfo->first()->avatar) : asset('storage/default-avatar.png') }}"
                 class="rounded-circle" style=" width: 150px; height: 150px;">
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
                 <p class="me-4 text-start">50 <strong>Posts</strong> </p>
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
 @endsection
