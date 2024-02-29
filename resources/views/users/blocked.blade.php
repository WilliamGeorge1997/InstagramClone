@extends('layouts.profile')

@section('content')
            <p class="mt-3 fw-bolder text-start fs-1 ">Blocked Users</p>
            <hr>
            @foreach ($blockedUsers as $blockedUser)
            <div class="card flex-row justify-content-between align-items-center d-flex border  mb-2 p-2">
                <span class="fw-bold m-0 p-0 ">{{ $blockedUser->blocked->username }}</span>
                <form method="POST" action=" {{ route('users.unblock', $blockedUser->blocked_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Unblock User</button>
                </form>
            </div>
            @endforeach
@endsection



