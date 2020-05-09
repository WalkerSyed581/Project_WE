<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabAppointment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
	}
	public function helpingStaff()
    {
        return $this->belongsTo('App\HelpingStaff');
	}
	public function prescription(){
		return $this->belongsTo('App\Prescription');
	}
	public function labTest(){
		return $this->belongsTo('App\LabTest');
	}
}
