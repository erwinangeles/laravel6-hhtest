<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class APIController extends Controller
{
    //
    function apiGet(Request $request){
        $key = $request->input('api_key');
        if(!$key){return response()->json('Request failed. No API key was provided.', 401);}

        $query = DB::table('api_keys')->where('key', '=', $key)->first();
        if(!$query){return response()->json('Request failed. Invalid API key was provided.', 401);}

        $user = User::findOrFail($query->user_id);
        return response()->json($user->attributes(), 201);
    }
     function apiPost(Request $request){
         $key = $request->input('api_key');
        
        if(!$key){return response()->json('Request failed. No API key was provided.', 401);}

        $query = DB::table('api_keys')->where('key', '=', $key)->first();
        if(!$query){return response()->json('Request failed. Invalid API key was provided.', 401);}
        
        //update Attributes
        

        return response()->json('User successfully updated', 201);

    }
}
