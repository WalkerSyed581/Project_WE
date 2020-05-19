<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
	protected $fillable = [
		'name','description','fee',
    ];
    public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function prescriptions()
	{
		return $this->belongsToMany('App\Prescription');
	}
}
