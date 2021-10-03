<?php

namespace App\Http\Controllers\API\Braider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ScheduleTiming;

class ScheduleTimingController extends Controller
{
    public function index(Request $request)
    {
    	$schedule = ScheduleTiming::where('braider_id',$request->user()->id)
    	->get();

    	return response()->json(['status' => true, 'schedule' => $schedule]);
    }
}
