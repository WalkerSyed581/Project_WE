<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
	protected $fillable = [
        'patient_id', 'doctor_id', 'time','notes','cancelled','approved',
    ];
	public function patient()
    {
        return $this->belongsTo('App\Patient');
	}
	public function doctor()
    {
        return $this->belongsTo('App\Doctor');
	}
	public function bill(){
		return $this->hasOne('App\Bill');
	}
	public function prescription()
    {
        return $this->hasOne('App\Prescription');
    }
}
