<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTechnology extends Model
{
    use HasFactory;

    protected $table='user_technologies';

     public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
