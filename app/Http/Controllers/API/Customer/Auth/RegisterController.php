<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

class RegisterController extends Controller
{	
	public function __construct(private User $user){}

    public function register(Request $request)
    {
    	DB::beginTransaction();
    	try {
    		
    		$this->validationForm($request);
    		$this->user->name = $request->name;
    		$this->user->email = $request->email;
    		$this->user->phone_number = $request->phone_number;
    		$this->user->password = Hash::make($request->password);
    		$this->user->save();
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
    		'phone_number' => ['required','numeric'],
    		'password' => ['required','min:6','max:50','confirmed'],
    		'password_confirmation' => ['required','min:6','max:50'],
    	]);

    	return $this;
    }
}
