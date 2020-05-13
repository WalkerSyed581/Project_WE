<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SupportGroupConductor extends Authenticatable
{
    public function supportGroups(){
		return $this->hasMany('App\SupportGroup');
	}
	public function user()
    {
        return $this->hasOne('App\User');
    }
}
