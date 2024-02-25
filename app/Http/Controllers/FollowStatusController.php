<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
