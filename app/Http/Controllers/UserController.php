<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function profile(){
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update(Request $request){
        $request->validate([
            'email' => 'email',
            'password' => 'confirmed'
        ]);
       Auth::user()->update([
           'email' => $request->email,
           'password' => bcrypt($request->password),
           'name' => $request->name,
       ]);

       return back()->with('message', 'Profile successfully updated!');
    }
}