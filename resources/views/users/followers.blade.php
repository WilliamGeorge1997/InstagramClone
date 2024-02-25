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
            <th>Avatar</th>
            <th>User</th>
            <th>Following</th>
            <th>Block</th>
        </thead>
        <tbody>
            @foreach($followersData as $followerData)

            <tr>

             <td> <img src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
                alt="Profile Picture" class="rounded-circle" style=" width: 50px; height: 50px;"></td>
                <td><a href="{{ route('users.show', $followerData->id) }}" class="text-decoration-none text-dark">{{ $followerData->fullname }}<br><span class="text-muted">{{ $followerData->username }}</span></a></td>
                <td>
                    @if(auth()->check() && auth()->user()->id !== $followerData->id)
                    @if(auth()->user()->isFollowing($followerData))
                        {{-- Unfollow button --}}
                        <form action="{{ route('users.unfollow', $followerData->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Unfollow</button>
                        </form>
                    @else
                        {{-- Follow/Follow Back button --}}
                        <form action="{{ route('users.follow', $followerData->id) }}" method="post" class="d-inline">
                            @csrf

                                @if($followerData->isFollowing(auth()->user()))
                                <button type="submit" class="btn btn-success">Follow Back</button>
                                @else
                                <button type="submit" class="btn btn-primary">Follow</button>

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
