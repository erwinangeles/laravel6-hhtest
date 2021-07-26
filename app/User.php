<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attributes(){
        //if no row exists for user yet, create it
        $query =  DB::table('user_attributes')->where('user_id', '=', $this->id)->first();

        if(!$query){
            DB::table('user_attributes')->where('user_id', '=', $this->id)->insert(['user_id' => $this->id]);
        }
        return DB::table('user_attributes')->where('user_id', $this->id)->first();
    }

    public function updateAttributes($data){
        //if no row exists for user yet, create it
        if(!$this->attributes()){
            DB::table('user_attributes')->where('user_id', '=', $this->id)->insert(['user_id' => $this->id]);
        }

        DB::table('user_attributes')->where('user_id', '=', $this->id)->update($data);
        return $this->attributes();
    }

    public function apiKeys(){
        return DB::table('api_keys')->where('user_id', $this->id)->get();
    }

    public function generateKey(){
        $key = Str::random(80);
         DB::table('api_keys')->insert([
            'user_id' => $this->id,
            'key' => $key,
        ]);

        return $key;
    }

}
