<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    //
    protected $fillable = [
        'user_id',
        'birthday',
        'gender',
        'country'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_attributes');
    }
}
