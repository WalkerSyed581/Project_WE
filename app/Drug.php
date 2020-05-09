<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    public function prescription(){
		return $this->belongsTo('App\Prescription');
	}
}
