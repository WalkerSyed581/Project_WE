<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Doctor extends Authenticatable
{
	protected $fillable = [
        'salary', 'specialization', 'starting_time','end_time','user_id','joining_date','fee',
    ];
    public function doctorAppointments()
    {
        return $this->hasMany('App\DoctorAppointment');
	}
	public function user()
    {
        return $this->hasOne('App\User');
    }
}
