<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);
              
        if($request->hasAny(['name', 'email'])){
            Auth::user()->update($request->only(['name', 'email']));
        };

       //update password if it's in the request
       if($request->password){ Auth::user()->update(['password' => bcrypt($request->password)]);}
        
        if($request->hasAny(['birthday', 'gender', 'country'])){
            Auth::user()->updateAttributes($request->only(['birthday', 'gender', 'country']));
        }

       return back()->with('message', 'Profile successfully updated!');
    }

    public function generateAPIKey(){
        Auth::user()->generateKey();
        return back()->with('message', 'API Key successfully added!');
    }
}
