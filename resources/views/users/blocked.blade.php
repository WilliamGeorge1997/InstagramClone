@extends('layouts.profile')

@section('content')
            <h2 class="mt-3 fw-bolder text-start fs-1 ">Blocked Users</h2>
            <hr>
            @foreach ($blockedUsers as $blockedUser)
            <div class=" flex-row justify-content-between align-items-center d-flex mb-2 p-2">
                <span class=" m-0 p-0 ">{{ $blockedUser->blocked->username }}</span>
                <form method="POST" action=" {{ route('users.unblock', $blockedUser->blocked_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Unblock User</button>
                </form>
            </div>
            <hr>
            @endforeach
@endsection



