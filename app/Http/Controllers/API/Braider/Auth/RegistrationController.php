<?php

namespace App\Http\Controllers\API\Braider\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserService;
use DB;
use Hash;

class RegistrationController extends Controller
{
    public function __construct(private User $user){}

    public function register(Request $request)
    {
    	DB::beginTransaction();
    	try {
    		
    		$this->validationForm($request)
    		->storeUser($request)
    		->storeService($request);

    		DB::commit();
    		return response()->json(['status' => true,'message' => 'Register successfull']);

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
    	$this->user->password = Hash::make($request->password);
    	$this->user->save();

    	return $this;
    }

    private function storeService(Request $request)
    {
    	if (count($request->services)) {
    		
    		foreach ($request->services as $key => $service) {
    			
    			$service = (object) $service;

    			$this->user->userServices()->create([
    				'service' => $service->service,
    				'hour' => $service->hour,
    				'min' => $service->min,
    				'price' => $service->price
    			]);
    		}
    	}
    }
}
