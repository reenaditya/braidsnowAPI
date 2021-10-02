<?php

namespace App\Http\Controllers\API\Braider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use Auth;

class MyCustomerController extends Controller
{	
	public function __construct(private Appointment $appointment){}
    public function index(Request $request)
    {
    	try {
    		
	    	$appoint = $this->appointment->select('email_id')
	    	->where('braider_id',Auth::id())
	    	->groupBy('email_id')
	    	->pluck('email_id');

	    	$appointment = User::whereIn('email',$appoint)->get();

	    	return response()->json(['status' => true,'data' => $appointment]);

    	} catch (Exception $e) {
    		
    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}
    }
}
