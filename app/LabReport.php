<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabReport extends Model
{
    public function labAppointment(){
		return $this->belongsTo('App\LabAppointment');
	}
}
