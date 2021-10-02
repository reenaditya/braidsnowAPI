<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Favourite;
use Auth;

class FavouriteController extends Controller
{
	public function __construct(private Favourite $favourite){}

    public function getFovourite()
    {
    	try {
    		
	    	$favourite = $this->favourite
	    	->with('braider')
	    	->where('user_id',Auth::id())
	    	->paginate(15);

	    	return response()->json(['status' => true,'data' => $favourite]);

    	} catch (Exception $e) {

    		return response()->json(['status' => false,'error' => $e->getMessage()]);
    	}
    }
}
