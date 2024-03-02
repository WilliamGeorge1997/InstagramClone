<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Block;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // return view('users.userprofile');

        //

    }

    public function search()
    {
        $searchQuery = request('search');

        if ($searchQuery) {
            $users = User::where('username', 'like', '%' . $searchQuery . '%')
                ->with('profiles')->get();

            return view('users.search', ['users' => $users, 'searchQuery' => $searchQuery]);
        } else {

            $users = [];
            return view('users.search', ['users' => $users]);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }
    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Redirect to the registration page if the user is not found
            return view('auth.register');
        }

        $currentUser = auth()->user();
        $user = User::find($id);
        // Check if there is a block record between the current user and the user to show
        $isBlocked = Block::where(function ($query) use ($currentUser, $user) {
            $query->where('blocker_id', $currentUser->id)
                ->where('blocked_id', $user->id);
        })->orWhere(function ($query) use ($currentUser, $user) {
            $query->where('blocker_id', $user->id)
                ->where('blocked_id', $currentUser->id);
        })->exists();

        // If there is a block record, prevent showing the profile
        if ($isBlocked) {
            return redirect()->route('posts.index');
        }

        $user = User::find($id);
        $profileInfo = Profile::where('user_id', $id)->get();
        $followController = app(FollowStatusController::class);
        $followCountData = $followController->followCount($user->id);
        $posts = Post::with('user', 'media', 'tags', 'likes')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')->get();
        return view('users.userprofile', ['user' => $user, 'posts' => $posts, 'profileInfo' => $profileInfo, 'followCountData' => $followCountData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (auth()->id() == $user->id) {
            $profileInfo = Profile::where('user_id', $id)->get();
            return view('users.edit', ['user' => $user, 'profileInfo' => $profileInfo]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::find($id);
        if (auth()->id() == $user->id) {
            $rules = [
                'password' => 'nullable|string|min:8',
            ];
            $request->validate($rules);
            $currentEmail = $user->email;


            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $path = $request->file('avatar')->store('avatars', 'public');
                Profile::where('user_id', $id)->update([
                    'avatar' => $path
                ]);
            }
            Profile::where('user_id', $id)->update([
                'gender' => $request->gender,
                'website' => $request->website,
                'bio' => $request->bio,
            ]);
            
            
            User::where('id', $id)->update([
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'email_verified_at' => null
            ]);
            if ($request->filled('password')) {
                User::where('id', $id)->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            if ($user->email !== $currentEmail) {
                try {
                    $user->sendEmailVerificationNotification();
                } catch (\Exception $e) {
                    $user->update(['email' => $currentEmail]);
                    return back()->withErrors(['email' => 'Failed to send email verification.']);
                }
            }
            return redirect()->route('users.show', auth()->id());
        }
        else
        {
            return redirect()->route('users.show', auth()->id());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
