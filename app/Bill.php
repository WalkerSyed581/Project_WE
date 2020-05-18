<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function patient(){
		return $this->belongsTo('App\Patient');
	}
	public function doctorAppointment(){
		return $this->belongsTo('App\DoctorAppointment');
	}
	public function labAppointment(){
		return $this->belongsTo('App\LabAppointment');
	}
	public function admission(){
		return $this->belongsTo('App\Admission');
	}
}
