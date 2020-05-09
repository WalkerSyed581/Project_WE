<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
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
}
