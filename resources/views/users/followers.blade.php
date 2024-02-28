@extends('layouts.profile')
@section('title','Followers Users')


@section('content')
@if($followersCount > 0)
    <div class="d-flex justify-content-lg-between my-4 border">
        <h4 >Followers Users</h4>
    <h4>Followers Count: {{ $followersCount }}</h4>
    </div>

    <table class="table border ">
        <thead>

            <th class="d-flex justify-content-start ps-5">User</th>
            <th>Following</th>
            <th>Block</th>
        </thead>
        <tbody>
            @foreach($followersData as $followerData)

            <tr>


                <td>
                    <div class="follower-container  d-flex ">
                        <a class="text-decoration-none" href="{{ route('users.show', $followerData->id) }}">
                            <div class="follower-avatar mx-2">
                                <img src="{{ $followerData->profiles->avatar ? Storage::url($followerData->profiles->avatar)  : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                            alt="Profile Picture" class="rounded-circle" style=" width: 50px; height: 50px;">
                            </div>
                            <div class="follower-user mt-1 mx-2">
                           <h6 class="m-0 text-dark"> {{ $followerData->fullname }}</h6>
                            <p class="m-0 ">{{ $followerData->username }}</p>
                        </a>
                            </div>

                    </div>
                </td>
                <td>
                    @if(auth()->check() && auth()->user()->id !== $followerData->id)
                    @if(auth()->user()->isFollowing($followerData))
                        {{-- Unfollow button --}}
                        <form action="{{ route('users.unfollow', $followerData->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger mt-1">Unfollow</button>
                        </form>
                    @else
                        {{-- Follow/Follow Back button --}}
                        <form action="{{ route('users.follow', $followerData->id) }}" method="post" class="d-inline">
                            @csrf

                                @if($followerData->isFollowing(auth()->user()))
                                <button type="submit" class="btn btn-success mt-1">Follow Back</button>
                                @else
                                <button type="submit" class="btn btn-primary mt-1">Follow</button>

                                @endif

                        </form>
                            @endif
                            @endif
                <td></td>
            </tr>

            @endforeach
        </tbody>
    </table>




    @else
        <h3 class="text-danger mt-5 pt-5" >No users being follow you.</h3>
    @endif


@endsection
