<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
	protected $fillable = [
        'ward_id', 'patient_id', 'helping_staff_id','from_date','number_of_days','discharged',
    ];
    public function ward()
    {
        return $this->belongsTo('App\Ward');
	}
	public function patient()
    {
		return $this->belongsTo('App\Patient');
	}
	public function helpingStaff()
    {
        return $this->belongsTo('App\HelpingStaff');
	}
	public function bill(){
		return $this->hasOne('App\Bill');
	}
}
