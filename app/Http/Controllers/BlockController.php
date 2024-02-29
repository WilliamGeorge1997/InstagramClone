<?php

namespace App\Http\Controllers;
use App\Models\Block;
use App\Models\User;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function blockUser(Request $request, $userId)
    {
        $userToFollow = User::findOrFail($userId);
        $authUser = auth()->user();
        $currentUser = User::find($authUser->id);
        $blocks = Block::with('blocked')->where('blocker_id', $currentUser->id)->get();
        $currentUser->unfollow($userToFollow);

        Block::create([
            'blocker_id' => $currentUser->id,
            'blocked_id' => $userToFollow->id,
        ]);
        return redirect()->back()->with(['blockedUsers' => $blocks]);
    }
    public function showBlockedUsers(string $id)
    {
        $currentUser = User::find($id);
        if (auth()->user() == $currentUser) {
            $authUser = auth()->user();
            $blockedUsers = Block::with('blocked')->where('blocker_id', $authUser->id)->get();
            return view('users.blocked', ['blockedUsers' => $blockedUsers, 'currentUser' => $currentUser]);
        } else {
            return view('auth.login');
        }
    }
    public function unblockUser(String $userId)
    {
        $userToUnblock = User::findOrFail($userId);
        $authUser = auth()->user();
        $currentUser = User::find($authUser->id);
        $blocks = Block::with('blocked')->where('blocker_id', $currentUser->id)->get();
        // dd($blocks);
        $usersToUnblock = Block::where('blocker_id', $authUser->id)
            ->where('blocked_id', $userToUnblock->id)
            ->delete();
        // dd($userToUnblock);
        return redirect()->back()->with(['currentUser' => $currentUser, 'blockedUsers' => $blocks]);
    }
}
