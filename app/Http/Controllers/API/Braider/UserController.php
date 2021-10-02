<?php

namespace App\Http\Controllers\API\Braider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

class UserController extends Controller
{
	public function __construct(private User $user){}

    public function userInformation(Request $request)
    {
    	$data = $request->user()->load('userServices','portfolio');
    	
    	return response()->json(['status' => true,'data' => $data ]);
    }
    
    public function update(Request $request)
    {
    	DB::beginTransaction();
    	try {
    		$this->user = $request->user();

    		$this->validationForm($request)
    		->storeUser($request)
    		->storeService($request);

    		DB::commit();
    		return response()->json(['status' => true,'message' => 'Profile Updated']);

    	} catch (Exception $e) {

    		DB::rollback();
    		return response()->json(['status' => false,'message' => $e->getMessage()]);    		
    	}
    }
    private function validationForm(Request $request)
    {
    	$request->validate([
    		'name' => ['required','min:3','max:255'],
    		'email' => ['required','email','unique:users,email'],
    		'avatar' => ['sometimes','image','size:244'],
    		'state' => ['required','min:3','max:255'],
    		'city' => ['required','min:3','max:255'],
    		'zipcode' => ['required','digits:8'],
    		'business_name' => ['nullable','string'],
    		'website_link' => ['nullable','string'],
    		'business_phone_number' => ['required','numeric'],
    		'introduction' => ['nullable','string'],
    		'special_introduction' => ['required'],
    		'policy_procedure' => ['required'],
    		'booking_deposit_amount' => ['required','numeric'],
    		'coupon_code' => ['nullable','string'],
    		'do_you_braid_out_of_a_shop' => ['sometimes','boolean'],
    		'do_you_braid_from_home' => ['sometimes','boolean'],
    		'are_you_a_mobile' => ['sometimes','boolean'],
    		'can_you_provide_hair' => ['sometimes','boolean'],
    		'do_you_wash_hair' => ['sometimes','boolean'],
    		'password' => ['required','min:6','max:50','confirmed'],
    		'password_confirmation' => ['required','min:6','max:50'],
    	]);

    	return $this;
    }
    private function storeUser(Request $request)
    {
    	$this->user->name = $request->name;
    	$this->user->email = $request->email;
    	if ($request->hasFile('avatar')) {
    		$this->user->avatar = $request->avatar->store('braider/profile','public');
    	}
    	$this->user->state = $request->state;
    	$this->user->city = $request->city;
    	$this->user->zipcode = $request->zipcode;
    	$this->user->business_name = $request->business;
    	$this->user->website_link = $request->webiste_link;
    	$this->user->business_phone_number = $request->businessPhoneNumber;
    	$this->user->introduction = $request->introduction;
    	$this->user->special_introduction = $request->special_introduction;
    	$this->user->policy_procedure = $request->policy_procedure;
    	$this->user->booking_deposit_amount = $request->booking_deposit_amount;
    	$this->user->coupon_code = $request->coupon_code;
    	$this->user->do_you_braid_out_of_a_shop = $request->do_you_braid_out_of_a_shop;
    	$this->user->do_you_braid_from_home = $request->do_you_braid_from_home;
    	$this->user->are_you_a_mobile = $request->are_you_a_mobile;
    	$this->user->can_you_provide_hair = $request->can_you_provide_hair;
    	$this->user->do_you_wash_hair = $request->do_you_wash_hair;
    	$this->user->save();

    	return $this;
    }
    private function storeService(Request $request)
    {
    	if (count($request->services)) {
    		
    		foreach ($request->services as $key => $service) {
    			
    			$service = (object) $service;

    			$this->user->userServices()->updateOrCreate([
    				'service' => $service->service
    			],[
    				'hour' => $service->hour,
    				'min' => $service->min,
    				'price' => $service->price
    			]);
    		}
    	}
    }
    public function changePassword(Request $request)
    {
    	$request->validate([
    		'old_password' => ['required'],
    		'password' => ['required','min:6','max:50','confirmed'],
    		'password_confirmation' => ['required','min:6','max:50'],
    	]);

    	if (Hash::check($request->old_password, $request->user()->password)) {
    		
    		$this->user = $request->user();
    		$this->user->password = Hash::make($request->password);
    		$this->user->save();

    		return response()->json(['status' => true,'message' => 'Password Successfully Changed']);

    	}else{
    		return response()->json(['status' => false,'errors' => ['old_password'=>['Incorrect Old Password']]],443);
    	}
    }

    public function logout(Request $request)
    {
    	$this->user = $request->user();

    	$this->user->api_token = "";
    	$this->user->save();

    	return response()->json(['status' => true,'message' => 'User Loged Out']);
    }
}
