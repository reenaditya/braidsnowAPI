<?php

namespace App\Http\Controllers\API\Braider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Portfolio;
use Auth;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
    	$request->validate([

    		'image' => ['required','image','max:244'],
    	]);

    	try {
	    	$portfolio = Portfolio::create([
	    		'image' => $request->image->store('portfolio','public'),
            	'braider_id' => $request->user()->id
            ]);

	    	return response()->json(['status' => true,'portfolio' => $portfolio]);

    	}
    	catch (Exception $e){
    		return response()->json(['status' => false,'message' => $e->getMessage()]);
    	}
    }
    public function index(Request $request)
    {	
    	try
    	{
    	$portfolio = Portfolio::where('braider_id',Auth::id())
    	->select('image')
    	->latest()
    	->get();
    	return response()->json(['status' => true,'data' => $portfolio]);
    	}

    	catch (Exception $e){
    		return response()->json(['status' => false,'message' => $e->getMessage()]);
    	}
    }
}
