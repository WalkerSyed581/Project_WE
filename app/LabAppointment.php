<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabAppointment extends Model
{
	protected $fillable = [
        'patient_id', 'helping_staff_id','prescription_id','lab_test_id', 'time','notes','cancelled','approved',
    ];
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
	public function labReport(){
		return $this->hasOne('App\LabReport');
	}
	public function bill(){
		return $this->hasOne('App\Bill');
	}
}
