<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Str;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$request->validate([

    		'email' => ['required','email','exists:users,email'],
    		'password' => ['required']
    	]);

    	$user = User::where('email',$request->email)
    	->where('status',1)
    	->first();

    	if ($user && Hash::check($request->password, $user->password)) {
    		
    		$user->api_token = Str::random(191);
    		$user->save();

    		return response()->json(['status'=> true, 'data' => $user]);

    	}else{

    		return response()->json(['status'=> false, 'error' => 'Email or password is incorrect!']);
    	}
    }
}
