<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportGroup extends Model
{
    public function supportGroupConductor()
    {
        return $this->belongsTo('App\SupportGroupConductor');
	}
	public function patients()
	{
		return $this->belongsToMany('App\Patient');
	}
}

