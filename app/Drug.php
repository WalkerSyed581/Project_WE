<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
	protected $fillable = [
		'prescription_id','name','dose',
    ];
    public function prescription(){
		return $this->belongsTo('App\Prescription');
	}
}
