<?php

namespace App\Http\Controllers\Admin;

use App\Models\Thought;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminThoughtController extends Controller
{
    
     
    public function index()
    {

    $thoughts=Thought::latest()->paginate(5);
    return view('admin.thoughts.index', compact('thoughts'));

    }
    

}
