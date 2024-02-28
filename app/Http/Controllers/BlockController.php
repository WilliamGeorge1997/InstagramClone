<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
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
