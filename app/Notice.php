<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable=[
        'notice_name','description','notice_type_id'
    ];
    protected $table='notices';
}
