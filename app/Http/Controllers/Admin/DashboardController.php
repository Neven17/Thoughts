<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Comment;
use App\Models\Thought;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\Constraint\Count;

class DashboardController extends Controller
{
    public function index()
    {
  
        /*  Jedna sintaksa
        if(!Gate::allows('admin')){                            //u Auth service provider sam definirao ime rute admin

            abort(403);
        }
        */

        $totalUsers=User::count(); 
        $totalThoughts=Thought::count(); 
        $totalComments=Comment::count(); 

        return view('admin.dashboard', compact('totalUsers','totalThoughts','totalComments'));
    }
}
