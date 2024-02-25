 @extends('layouts.profile')
    @section('content')
    <div class=" mt-5 mx-auto">
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
                            <div class="row align-items-center">
                                <span class="fs-4 col-4">{{ $user->username }}</span>
                                <!-- Edit Profile Button -->
                                {{-- Follow/Unfollow button --}}

                                @if(auth()->check() && auth()->user()->id !== $user->id)
                                @if(auth()->user()->isFollowing($user))
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

                                            @if($user->isFollowing(auth()->user()))
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
                                    <p>50 <strong>Posts</strong> </p>
                                </div>
                                <!-- Followers, Following, Posts -->
                                <div class="col">
                                    <!-- Followers -->
                                    <p><strong><a class="text-decoration-none text-muted" href="{{ route('users.followers', $user->id) }}">Followers: {{ $followCountData['followersCount']}}</a></strong></p>
                                </div>
                                <div class="col">
                                    <!-- Following -->
                                 <p><strong><a class="text-decoration-none text-muted" href="{{ route('users.followings', $user->id) }}">Following: {{ $followCountData['followingCount']}}</a></strong></p>
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

        </div>
        </div>
    @endsection

