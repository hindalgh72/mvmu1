<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable=[
        'user_role','description'
    ];

    protected $table='user_role';
}
