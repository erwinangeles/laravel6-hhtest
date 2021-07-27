<?php

namespace App\Http\Controllers;

Use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('users.auth.login');
    }

    public function register(){
        return view('users.auth.register');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->intended('user/profile');
        }

        $error = "These credentials do not match our records.";
        return back()->withErrors($error);
    }

    public function postRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        DB::table('user_attributes')->insert(['user_id' => $user->id]);

        return redirect()->route('login')->with(['message' => 'Successfully created account. Please login to continue.']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
