<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    public function doctorAppointments()
    {
        return $this->hasMany('App\DoctorAppointment');
	}
	public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function admissions()
    {
        return $this->hasMany('App\Admission');
	}
	public function supportGroups()
	{
		return $this->belongsToMany('App\SupportGroup');
	}
	public function bills()
    {
        return $this->hasMany('App\Bill');
	}
}
