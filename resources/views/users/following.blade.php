@extends('layouts.profile')
@section('title', 'Following Users')
@section('content')
    @if ($followingCount > 0)
        <div class="d-flex justify-content-lg-between my-4 border">
            <h4>Following Users</h4>
            <h4>Followings Count: {{ $followingCount }}</h4>
        </div>


        <table class="table border ">
            <thead>
                <th>Avatar</th>
                <th>User</th>
                <th>Following</th>
                <th>Block</th>
            </thead>
            <tbody>
                @foreach ($followingsData as $followingData)
                    <tr>

                        <td> <img
                                src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
                                alt="Profile Picture" class="rounded-circle" style=" width: 50px; height: 50px;"></td>
                        <td><a href="{{ route('users.show', $followingData->id) }}"
                                class="text-decoration-none text-dark">{{ $followingData->fullname }}<br><span
                                    class="text-muted">{{ $followingData->username }}</span></a></td>
                        <td>
                            @if (auth()->check() && auth()->user()->id !== $followingData->id)
                                @if (auth()->user()->isFollowing($followingData))
                                    {{-- Unfollow button --}}
                                    <form action="{{ route('users.unfollow', $followingData->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Unfollow</button>
                                    </form>
                                @else
                                    {{-- Follow/Follow Back button --}}
                                    <form action="{{ route('users.follow', $followingData->id) }}" method="post"
                                        class="d-inline">
                                        @csrf

                                        @if ($followingData->isFollowing(auth()->user()))
                                            <button type="submit" class="btn btn-success">Follow Back</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Follow</button>
                                        @endif

                                    </form>
                                @endif
                            @endif
                        </td>

                        <td>
                            @if (auth()->check() && auth()->user()->id !== $followingData->id)
                                <form method="POST" action="{{ route('users.block', $followingData->id) }}" class="mx-3">
                                    @csrf
                                    <button type="submit" class="btn btn-danger px-4">Block</button>
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
