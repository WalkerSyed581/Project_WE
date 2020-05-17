<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
	protected $fillable = [
        'patient_id', 'doctor_id', 'time','notes','cancelled','approved',
    ];
	public function user()
    {
        return $this->belongsTo('App\User');
	}
	public function doctor()
    {
        return $this->belongsTo('App\Doctor');
	}
}
