
    {{-- Follow/Unfollow button --}}
    @if(auth()->check() && auth()->user()->id !== $user->id)
        @if(auth()->user()->isFollowing($user))
            {{-- Unfollow button --}}
            <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Unfollow</button>
            </form>
        @else
            {{-- Follow/Follow Back button --}}
            <form action="{{ route('users.follow', $user->id) }}" method="post">
                @csrf
                <button type="submit">
                    @if($user->isFollowing(auth()->user()))
                        Followed Back
                    @else
                        Follow
                    @endif
                </button>
            </form>
        @endif
    @endif

    {{-- Display user's posts --}}
    @foreach($posts as $post)
        {{-- Display each post --}}
    @endforeach
</div>