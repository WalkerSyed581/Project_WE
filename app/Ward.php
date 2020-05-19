<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
	protected $fillable = [
		'capacity',
    ];
    public function admissions()
    {
        return $this->hasMany('App\Admission');
	}
}
