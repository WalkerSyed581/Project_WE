<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportGroup extends Model
{
	protected $fillable = [
        'support_group_conductor_id', 'name', 'day','timing','description','fee',
    ];
    public function supportGroupConductor()
    {
        return $this->belongsTo('App\SupportGroupConductor');
	}
	public function patients()
	{
		return $this->belongsToMany('App\Patient');
	}
}

