<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtLikeController extends Controller
{
    public function like(Thought $thought)
    {
        
        $liker = auth()->user();   

       

        $liker->likes()->attach($thought);     //taj user ce koristiti relacije likes , many to many, attach je umetni

        return redirect()->route('dashboard');


    }



    public function unlike(Thought $thought)
    {


        $liker = auth()->user();     


        $liker->likes()->detach($thought);     //taj user ce koristiti relacije likes , many to many, attach je umetni

        return redirect()->route('dashboard');
      


    }
}
