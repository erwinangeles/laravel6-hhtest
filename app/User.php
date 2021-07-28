<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\ApiKey;
use App\UserAttribute;

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
        return $this->hasOne(UserAttribute::class);
    }

    public function setAttributes(){
        return UserAttribute::create(['user_id' => $this->id]);
    }

    public function apiKeys(){
        return $this->hasMany(ApiKey::class);
    }

    public function generateKey(){
        $key = Str::random(80);
        $this->apiKeys()->create([
            'user_id' => $this->id,
            'key' => $key,
        ]);
        return $key;
    }

}
