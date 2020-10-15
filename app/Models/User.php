<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function searchConnectionRecords($search)
    {
        $object=self::select('users.id','users.first_name','users.last_name','users.email','users.phone','user_technologies.technology');

        $object->leftJoin('user_technologies',function($join){
            $join->on('user_technologies.user_id','users.id');
        });

        $object->where(function($q)use ($search){
            $q->where('users.first_name','like','%'.$search.'%');
            $q->orwhere('users.last_name','like','%'.$search.'%');
            $q->orwhere('users.email','like','%'.$search.'%');
            $q->orwhere('users.phone','like','%'.$search.'%');
            $q->orwhere('user_technologies.technology','like','%'.$search.'%');
        });

        //$object->groupBy('users.id');

        return $object->get();
    }

    public function technology(){
        return $this->hasMany('App\Models\UserTechnology','user_id','id');
    }
}
