<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminUserController extends Controller
{


    public function index()
    {

    $users=User::latest()->paginate(5);
    return view('admin.users.index', compact('users'));

    }
}
