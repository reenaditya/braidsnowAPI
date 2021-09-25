<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
	public $fillable = [
		'service',
		'hour',
		'min',
		'price'
	];
	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
