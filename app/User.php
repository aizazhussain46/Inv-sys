<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = ['name','role_id','email','password','emp_no','branch','location','contact','department','cell','designation','hdd','extention','status'];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $with = [
        'role:id,role'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
