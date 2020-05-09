<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function prescriptions()
	{
		return $this->belongsToMany('App\Prescription');
	}
}
