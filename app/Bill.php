<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function patient(){
		return $this->belongsTo('App\Patient');
	}
	public function doctorAppointment(){
		return $this->hasOne('App\DoctorAppointment');
	}
	public function labAppointment(){
		return $this->hasOne('App\LabAppointment');
	}
	public function admission(){
		return $this->hasOne('App\Admission');
	}
}
