<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HelpingStaff extends Authenticatable
{
	protected $fillable = [
        'salary','user_id','joining_date','role',
	];
	
    public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function admissions()
    {
        return $this->hasMany('App\Admission');
	}
	public function user()
    {
        return $this->belongsTo('App\User');
    }
}
