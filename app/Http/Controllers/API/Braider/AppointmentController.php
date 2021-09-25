<?php

namespace App\Http\Controllers\API\Braider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use Carbon\Carbon;
use Auth;

class AppointmentController extends Controller
{
    public function __construct(private Appointment $appointment){}

    public function getAllAppointment()
    {
    	try {
    		
	    	$appointment = $this->appointment
	    	->with('user','appointmentBookedServices.service')
	    	->where('braider_id',Auth::id())
	    	->paginate(15);

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {

    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}

    }

    public function getTodayAppointment()
    {
    	try {
    		
	    	$appointment = $this->appointment
	    	->with('user','appointmentBookedServices.service')
	    	->where('braider_id',Auth::id())
	    	->whereDate('schedule_date',Carbon::today())
	    	->paginate(15);

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {
    		
    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}

    }

    public function getUpcomingAppointment()
    {
    	try {
    		
	    	$appointment = $this->appointment
	    	->with('user','appointmentBookedServices.service')
	    	->where('braider_id',Auth::id())
	    	->whereDate('schedule_date',Carbon::today())
	    	->paginate(15);

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {
    		
    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}
    }

    public function totalCustomer()
    {
    	try {
    		
	    	$appointment = $this->appointment
	    	->where('braider_id',Auth::id())
	    	->groupBy('email_id')
	    	->count();

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {
    		
    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}
    }

    public function newCustomer()
    {
    	try {
    		
	    	$appointment = $this->appointment
	    	->where('braider_id',Auth::id())
	    	->groupBy('email_id')
	    	->whereDate('schedule_date',Carbon::today())
	    	->count();

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {
    		
    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}
    }

    public function totalAppointment()
    {
    	try {
    		
	    	$appointment = $this->appointment
	    	->where('braider_id',Auth::id())
	    	->count();

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {
    		
    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}
    }
}
