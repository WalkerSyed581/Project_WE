<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
	protected $fillable = [
		'doctor_appointment_id','notes','condition',
    ];
    public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function drugs()
    {
        return $this->hasMany('App\Drug');
	}
	public function doctorAppointment()
    {
        return $this->belongsTo('App\DoctorAppointment');
    }
	public function labTests()
	{
		return $this->belongsToMany('App\LabTest');
	}
}
