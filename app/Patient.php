<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\User;
class Patient extends Model
{

	protected $fillable = [
        'user_id','emergencey_contact',
	];
	public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function doctorAppointments()
    {
        return $this->hasMany('App\DoctorAppointment');
	}
	public function labAppointments()
    {
        return $this->hasMany('App\LabAppointment');
	}
	public function admissions()
    {
        return $this->hasMany('App\Admission');
	}
	public function supportGroups()
	{
		return $this->belongsToMany('App\SupportGroup');
	}
	public function bills()
    {
        return $this->hasMany('App\Bill');
	}
}
