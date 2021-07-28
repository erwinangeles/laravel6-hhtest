<?php

use Illuminate\Http\Request;
use App\User;
use App\ApiKey;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('custom.auth')->get('/users', function (Request $request) {
    $user = ApiKey::where('key', '=', $request->api_key)->firstOrFail()->user;

    $data = [
        'name' => $user->name,
        'email' => $user->email,
        'birthday' => $user->attributes->birthday,
        'gender' => $user->attributes->gender,
        'country' => $user->attributes->country
    ];

    return response()->json($data, 201);
});


Route::middleware('custom.auth')->post('/users', function (Request $request) {
    $user = ApiKey::where('key', '=', $request->api_key)->firstOrFail()->user;

    $user->update($request->only(['name', 'email']));
    $user->attributes->update($request->only(['birthday', 'gender', 'country']));


    return response()->json('User data and attributes successfully updated.', 201);
});