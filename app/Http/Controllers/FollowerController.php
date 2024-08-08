<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UserFollowed;

class FollowerController extends Controller
{
    public function follow(User $user)  
    {
        $follower = auth()->user();   

        $follower->followings()->attach($user);   

        $follower->blockings()->detach($user);

        $user->notify(new UserFollowed($follower));

        return redirect()->route('users.show', $user->id);
    }


    public function unfollow(User $user)
    {

        $follower = auth()->user();   
        $follower->followings()->detach($user);   
        return redirect()->route('users.show', $user->id);
    }
}
