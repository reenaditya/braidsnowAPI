<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	public $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function appointmentBookedServices()
    {
    	return $this->hasMany(AppointmentBookedService::class);
    }
}
