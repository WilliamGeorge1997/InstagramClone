<?php

namespace App\Http\Controllers;


use App\Models\Profile;
use App\Models\User;

use Illuminate\Http\Request;

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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('users.create');

        //

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
        $user = User::find($id);
        // if (auth()->id() == $user->id) {
        $profileInfo = Profile::where('user_id', $id)->get();
        $followController = app(FollowStatusController::class);
        $followCountData = $followController->followCount($user->id);
        return view('users.userprofile', ['user' => $user, 'profileInfo' => $profileInfo, 'followCountData' => $followCountData]);
        // } 
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

        // dd($request);

        // $user = User::find($id);

        // if (auth()->id() == $user->id) {
        //     Profile::where('user_id', $id)->update([
        //         'gender' => $request->gender,
        //         'website' => $request->website,
        //         'bio' => $request->bio,
        //         'avatar' => $request->avatar
        //     ]);
        //     return redirect()->route('users.show', auth()->id());
        // } else {
        //     return redirect()->route('users.show', auth()->id());
        // }

        $user = User::find($id);
        if (auth()->id() == $user->id) {


                if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                    $path = $request->file('avatar')->store('avatars', 'public');
                    Profile::where('user_id', $id)->update([
                        'gender' => $request->gender,
                        'website' => $request->website,
                        'bio' => $request->bio,
                        'avatar' => $path
                    ]);
                } else {
                    Profile::where('user_id', $id)->update([
                        'gender' => $request->gender,
                        'website' => $request->website,
                        'bio' => $request->bio,
                    ]);
                }
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
};
