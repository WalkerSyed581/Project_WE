<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','phone','cnic','gender','age','role',
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
	
	public function doctor()
    {
        return $this->hasOne('App\Doctor');
	}
	public function patient()
    {
        return $this->hasOne('App\Patient');
	}
	public function supportGroupConductor()
    {
        return $this->hasOne('App\SupportGroupConductor');
	}
	public function helpingStaff()
    {
        return $this->hasOne('App\HelpingStaff');
    }
}


