<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user)   //$user - je user kojeg zelimo follovati       Ovo se zove model binding
    {
        $follower = auth()->user();   //naš follower ce biti PRIJAVLJEN korisnik

        $follower->followings()->attach($user);    //atach dodavanje novog zapisa u bazu 

        $follower->blockings()->detach($user);

        return redirect()->route('users.show', $user->id);
    }


    public function unfollow(User $user)
    {

        $follower = auth()->user();   
        $follower->followings()->detach($user);    //Metoda detach() koristi se u Laravelu za uklanjanje veze iz tablice veza mnogo-na-mnogo (Many-to-Many) između dva entiteta.
        return redirect()->route('users.show', $user->id);
    }
}
