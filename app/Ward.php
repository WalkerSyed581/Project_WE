<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public function admissions()
    {
        return $this->hasMany('App\Admission');
	}
}
