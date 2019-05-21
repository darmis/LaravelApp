<?php

namespace Ciklas;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'photo', 'role_id', 'email', 'password',
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

    
    // Only accept a valid password and 
    // hash a password before saving
    public function setPasswordAttribute($password)
    {
        if ( $password !== null & $password !== "" )
        {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    //add one to many relationship
    public function repairs() {
        return $this->hasMany('Ciklas\Repair');
    }
}
