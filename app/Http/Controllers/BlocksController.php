<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BlocksController extends Controller
{


    public function block(User $user)
    {
        $blocker = auth()->user();    //mora biti prijavljeni korisnik da bi mogao to raditi

        $blocker->blockings()->attach($user);

        // Automatsko unfollowanje korisnika nakon bloka
        $blocker->followings()->detach($user);

        return redirect()->route('users.show', $user->id);
    }

    public function unblock(User $user)
    {
        $blocker = auth()->user();

        $blocker->blockings()->detach($user);

   

        return redirect()->route('users.show', $user->id);
    }


    public function isBlockedBy()
    {
        
    }
    
}

