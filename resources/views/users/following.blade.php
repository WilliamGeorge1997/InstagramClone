@extends('layouts.profile')
@section('title', 'Following Users')
@section('content')
    @if ($followingCount > 0)
        <div class="d-flex justify-content-between my-1 mt-3 ">
            <h2 class="fs-1 fw-bold">Following Users</h2>
            <h5 class="d-flex align-items-center mt-1">Followings Count {{ $followingCount }}</h5>
        </div>
            <hr>

               <table class="table  rounded ">
                <tbody>
                    @foreach($followingsData as $followingData)

                    <tr>

                        <td>
                            <div class="following-container  d-flex ">
                                <a class="text-decoration-none" href="{{ route('users.show', $followingData->id) }}">
                                    <div class="following-avatar mx-2">
                                        <img src="{{ $followingData->profiles->avatar ? Storage::url($followingData->profiles->avatar)  : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                                    alt="Profile Picture" class="rounded-circle" style=" width: 50px; height: 50px;">
                                    </div>
                                    <div class="following-user mt-1 mx-2">
                                   <h6 class="m-0 text-dark"> {{ $followingData->fullname }}</h6>
                                    <p class="m-0 ">{{ $followingData->username }}</p>
                                </a>
                                    </div>

                            </div>
                        </td>
                        <td>
                            @if (auth()->check() && auth()->user()->id !== $followingData->id)
                                @if (auth()->user()->isFollowing($followingData))
                                    {{-- Unfollow button --}}
                                    <form action="{{ route('users.unfollow', $followingData->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger mt-2">Unfollow</button>
                                    </form>
                                @else
                                    {{-- Follow/Follow Back button --}}
                                    <form action="{{ route('users.follow', $followingData->id) }}" method="post"
                                        class="d-inline">
                                        @csrf

                                        @if ($followingData->isFollowing(auth()->user()))
                                            <button type="submit" class="btn btn-success mt-2">Follow Back</button>
                                        @else
                                            <button type="submit" class="btn btn-primary mt-2">Follow</button>
                                        @endif

                                    </form>
                                @endif
                            @endif
                        </td>

                        <td>
                            @if (auth()->check() && auth()->user()->id !== $followingData->id)
                                <form method="POST" action="{{ route('users.block', $followingData->id) }}" class="mx-3">
                                    @csrf
                                    <button type="submit" class="btn btn-danger px-4 mt-2">Block</button>
                                </form>
                            @endif
                            {{-- <form method="POST" action="{{ route('users.block', $followingData->id) }}" class="mx-3">
                                    @csrf
                                    <button type="submit" class="btn btn-primary px-4">Block</button>
                                </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text-danger mt-5 pt-5">No users being followed.</h3>
    @endif
@endsection
