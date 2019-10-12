<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','birthday', 'id', 'user_id'
    ];

    function user(){
        return $this->belongsTo('App\User',"user_id");
    }
}
