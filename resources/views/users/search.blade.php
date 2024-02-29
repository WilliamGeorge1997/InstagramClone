@extends('layouts.profile')
@section('title', 'Users Search')
@section('style')
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section('content')

    <div class="search-container mt-3">


        <form method="GET" class="d-flex">
            <input type="search" class="form-control" placeholder="Search for username" name="search"
                value="{{ request('search') }}">
            <input type="submit" name="submit" value="Search" class="btn btn-primary ms-2">
        </form>


       <div class="search-result mt-3">
        @if(request('search'))
        @if ($users->isEmpty())
            <h6 class="text-danger">No users found.</h6>
        @else
            @forelse($users as $user)
            <div class="d-flex border p-3">
                <a class="text-decoration-none text-dark" href="{{ route('users.show', $user->id) }}">
                <div class="user-avatar d-flex align-items-center justify-content-center">
                    <img class="profile-pic align-middle" src="{{ $user->profiles->avatar ?  Storage::url($user->profiles->avatar)  : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}" alt="Profile Avatar">
                </div>
                <div class="search-content ">
                    <h6 class="m-0">{{ $user->fullname }}</h6>
                  <span class="text-primary"> {{$user->username }}</span>
                </a>
                </div>
            </div>
            @empty
            <h6 class="text-danger">User not found</h6>
            @endforelse
        @endif
        @else
        <h6 class="text-danger">Please enter a username and submit to search.</h6>
        @endif

       </div>
    </div>
@endsection
