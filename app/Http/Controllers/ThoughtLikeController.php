<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;
use App\Notifications\LikeThought;

class ThoughtLikeController extends Controller
{
    public function like(Thought $thought)
    {

        $liker = auth()->user();
        $liker->likes()->attach($thought);

        $thought->user->notify(new LikeThought($liker, $thought));

        return back();
    }



    public function unlike(Thought $thought)
    {


        $liker = auth()->user();


        $liker->likes()->detach($thought);

        return back();
    }
}
