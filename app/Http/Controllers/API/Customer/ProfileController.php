<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Hash;

class ProfileController extends Controller
{
   public function __construct(private User $user){}

    public function getInformation(Request $request)
    {
    	return response()->json(['status' => true,'user' => $request->user()]);
    }

   public function update(Request $request)
   {
   		DB::beginTransaction();
    	try {

	   		$this->user = Auth::user();
	        $request->validate([
	   	  		'avatar' => ['sometimes','image'],
	   	  		'name' => ['required', 'min:3', 'max:255'],
	   	  		'dob' => ['required','date'],
	   	  		'email' => ['required', 'email','unique:users,email,'.Auth::id()],
	   	  		'phone_number' => ['required', 'numeric'],
	   	  		'address' => ['required'],
	   	  		'state' => ['required','min:3','max:255'],
	    		'city' => ['required','min:3','max:255'],
	    		'zipcode' => ['required','max:8'],
	    		'country' => ['required']
   	  		]);

   	  		if ($request->hasFile('avatar')) {
    		$this->user->avatar = $request->avatar->store('customer/profile','public');
	    	}
	   	 	$this->user->name = $request->name;
	   	 	$this->user->dob = $request->dob;
	   	 	$this->user->email = $request->email;
	   	 	$this->user->phone_number = $request->phone_number;
	   	 	$this->user->address = $request->address;
	   	 	$this->user->state = $request->state;
	   	 	$this->user->city =$request->city;
	   	 	$this->user->zipcode = $request->zipcode;
	   	 	$this->user->country = $request->country;
	   	 	$this->user->save();

	        db::commit();
	        return response()->json(['status' => true, 'message' => 'Profile Updated']);

	    }catch(Exception $e){
	    
	    	DB::rollback();
    		return response()->json(['status' => false,'message' => $e->getMessage()]);
	    }
   }

   public function changePassword(Request $request)
   {

    	$this->user = Auth::user();
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
    		return response()->json(['status' => false,'error' => 'Incorrect Old Password']);
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
