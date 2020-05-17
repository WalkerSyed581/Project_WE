<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SupportGroupConductor extends Authenticatable
{
	protected $fillable = [
        'salary','user_id','joining_date',
	];
    public function supportGroups(){
		return $this->hasMany('App\SupportGroup');
	}
	public function user()
    {
        return $this->belongsTo('App\User');
    }
}
