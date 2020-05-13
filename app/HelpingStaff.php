<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HelpingStaff extends Authenticatable
{
    public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function admissions()
    {
        return $this->hasMany('App\Admission');
	}
	public function user()
    {
        return $this->hasOne('App\User');
    }
}
