<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Service;
use Auth;
use DB;

class HomepageController extends Controller
{
    public function __construct(private User $user){}

    public function getService(Request $request)
    {
    	$service = Service::withCount('userServices')->latest('sorting')
    	->take(6)
    	->get();

    	return response()->json(["status"=> true,"data" => $service]);
    }

    public function getTopBraider(Request $request)
    {
    	$braider = $this->user
    	->select('id','name','ratting','avatar')
    	->where('top_braiders', true)
    	->with('userServices:user_id,service,price')
    	->whereStatus(true)
    	->latest()
    	->take(4)
    	->get();
    	
    	return response()->json(["status"=> true,"data" => $braider]);

    }


}
