@extends('layouts.main');

@section('content')

    <form method="GET">
        <input type="search" class="form-control" placeholder="Search for username" name="search"
            value="{{ request('search') }}">
        {{-- <input type="submit" name="submit" value="Search" class="btn btn-primary"> --}}
    </form>


    @forelse($users as $user)
        <p> {{ $user->username }} </p>
    @empty
        <p>User not found</p>
    @endforelse
@endsection