<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabReport extends Model
{
	protected $fillable = [
		'lab_appointment_id','report_text',
    ];
    public function labAppointment(){
		return $this->belongsTo('App\LabAppointment');
	}
}
