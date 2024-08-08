<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');

    }

    public function store()
    {

    

        $validated= request()->validate([
            'name'=>'required|unique:users|min:3|max:40',
            'email'=>'required|email|unique:users,email',   
            'password'=>'required|confirmed|min:8',   

        ]);

        $user= User::create([
            'name'=>$validated['name'],
            'email'=> $validated['email'],
            'password'=>Hash::make($validated['password']),



        ]);
        Mail::to($validated['email'])->send(new WelcomeEmail($user));
       

        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');

    }



    public function login()
    {
        return view('auth.login');

    }

    public function authenticate()
    {


        $validated= request()->validate([
            
            'email'=>'required|email',  
            'password'=>'required|min:8',  

        ]);

        if (auth()->attempt($validated)){
            request()->session()->regenerate();                                                   

            return redirect()->route('dashboard');
        }


    

        return redirect()->route('login')->withErrors([
            'email' => 'No matching user found with the provided email and password'
        ]);

    }


    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logged out successfully!');
    }


    //ZA APIJE

    public function createToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (! $user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = Auth::user()->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

}
