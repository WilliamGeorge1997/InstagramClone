    @extends('layouts.main')
    @section('content')
        <div class="mt-5">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <!-- Profile Picture -->
                    <div class="text-center">
                        <img src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
                            alt="Profile Picture" class="rounded-circle" style=" width: 150px; height: 150px;">
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- Username -->
                    <section class="d-flex flex-column mb-3">
                        <div class="row">
                            <!-- Username -->
                            <span class="fs-4 col-4 text-start">{{ $user->username }}</span>
                            <!-- Edit Profile Button -->
                            {{-- Follow/Unfollow button --}}

                            @if (auth()->check() && auth()->user()->id !== $user->id)
                                @if (auth()->user()->isFollowing($user))
                                    {{-- Unfollow button --}}
                                    <div class="col-4">
                                        <form action="{{ route('users.unfollow', $user->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-primary col-8">Unfollow</button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Follow/Follow Back button --}}
                                    <div class="col-4">
                                        <form action="{{ route('users.follow', $user->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary col-8">
                                                @if ($user->isFollowing(auth()->user()))
                                                    Followed Back
                                                @else
                                                    Follow
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif

                            @if (Auth::check() && $user->id == Auth::user()->id)
                                <div class="col-4">
                                    <!-- Edit Profile Button -->
                                    <a href=" {{ route('users.edit', $user->id) }}"><button class="btn btn-primary col-8">
                                            Edit Profile</button></a>
                                </div>
                            @endif

                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <!-- Posts -->
                                <p class="m-0 text-start pt-1">50 <strong>Posts</strong> </p>
                            </div>
                            <!-- Followers, Following, Posts -->
                            <div class="col">
                                <!-- Followers -->
                                <p class="m-0 text-start"> {{ $followCountData['followersCount'] }} <strong>Followers
                                    </strong></p>
                            </div>
                            <div class="col">
                                <!-- Following -->
                                <p class="m-0 text-start"> {{ $followCountData['followingCount'] }}
                                    <strong>Following</strong>
                                </p>
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
        </div>
        </div>
    @endsection
