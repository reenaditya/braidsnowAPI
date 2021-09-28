<?php

namespace App\Http\Controllers\API\Braider\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Str;

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
    	->with('userServices')
    	->first();

    	if ($user && Hash::check($request->password, $user->password)) {
    		
    		$token = Str::random(191);

    		$user->api_token = $token;
    		$user->save();

    		return response()->json([
    			'status' => true,
    			'token' => $token,
    			'user' => $user
    		]);

    	}else{

    		return response()->json(['status'=> false,'errors' => ['email'=>['Email or password is incorrect!']]],443);
    	}
    }
}
