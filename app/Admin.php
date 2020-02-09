<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $fillable = [
        'first_name', 'email', 'password','last_name','username', 'reset_token', 'phone_number'
    ];
}
