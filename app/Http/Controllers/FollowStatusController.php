<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class FollowStatusController extends Controller
{
    public function followUser(Request $request, $userId)
{
    $userToFollow = User::findOrFail($userId);
    $authUser = auth()->user();
    $currentUser = User::find($authUser->id);

    if ($currentUser->isFollowing($userToFollow))

    {
        $currentUser->unfollow($userToFollow);
    }
    else
    {
        $currentUser->follow($userToFollow);

        if ($userToFollow->isFollowing($currentUser))
        {
            $userToFollow->follow($currentUser);
        }
    }
    return redirect()->back();
}

public function followCount(string $id)
 {
    $user = User::withCount('posts')->find($id);

    if (!$user)
    {
        return redirect()->route('users.index');
    }

    $followersCount = $user->followers()->count();
    $followingCount = $user->followings()->count();

    return compact('followersCount', 'followingCount');
 }



 public function followingUsers(string $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.show', $user->id);
    }

    $followingUsers = $user->followings()->get();

    $followingCount = $followingUsers->count();

    $followableIds = $followingUsers->map->followable_id->toArray();


    $followingsData = User::with('profiles')->whereIn('id', $followableIds)->get();





    return view('users.following', compact('followingsData' ,'followingCount','user'));


}

public function followerUsers(string $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.show', $id);
    }

    $followerUsers = $user->followers()->get();

    $followersCount = $followerUsers->count();
    $followerIds = $followerUsers->map(function ($follower) {return $follower->id;})->toArray();


    $followersData = User::with('profiles')->whereIn('id', $followerIds)->get();
    

    return view('users.followers', compact('followersData', 'followersCount', 'user'));
}

}
