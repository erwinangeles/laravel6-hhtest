<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'api_keys';

    protected $fillable = [
        'user_id', 'key'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}