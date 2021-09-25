<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class CommonController extends Controller
{
	public function __construct(private Service $service){}

    public function getAllServices()
    {
    	$data = $this->service->latest('sorting')->get();
    	
    	return response()->json(["status"=> true,"data" => $data]);
    }
}
