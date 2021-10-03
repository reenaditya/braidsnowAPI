<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleTiming extends Model
{

	public function braider()
	{
		return $this->belongsTo(User::class,'braider_id');
	}
}
