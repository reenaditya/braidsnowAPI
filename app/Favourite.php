<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function braider()
    {
    	return $this->belongsTo(User::class,'braider_id');
    }
}
