<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|---------------------------------------------------------------------------
|	Common API
|---------------------------------------------------------------------------
*/
Route::group(['namespace' => 'API'], function() {
	/*
	|---------------------------------------------------------------------------
	|	Get All Service List
	|---------------------------------------------------------------------------
	*/
	Route::get('services','CommonController@getAllServices');

});
/*
|---------------------------------------------------------------------------
|	Braiders Guest Routes
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'braider','namespace' => 'API\Braider'], function() {
	/*
	|---------------------------------------------------------------------------
	|	Register Braiders
	|---------------------------------------------------------------------------
	*/
	Route::post('register','Auth\RegistrationController@register');

	Route::post('login','Auth\LoginController@login');

});
/*
|---------------------------------------------------------------------------
|	Braiders Auth Routes
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'braider','namespace' => 'API\Braider','middleware' => 'auth:api'], function() {
	/*
	|---------------------------------------------------------------------------
	|	Get All Appointment
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/get-all','AppointmentController@getAllAppointment');
	/*
	|---------------------------------------------------------------------------
	|	Get Today Appointment
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/today','AppointmentController@getTodayAppointment');
	/*
	|---------------------------------------------------------------------------
	|	Get Upcoming Appointment
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/upcoming','AppointmentController@getUpcomingAppointment');
	/*
	|---------------------------------------------------------------------------
	|	Total Customer
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/total-customer','AppointmentController@totalCustomer');
	/*
	|---------------------------------------------------------------------------
	|	New Customer
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/new-customer','AppointmentController@newCustomer');
	/*
	|---------------------------------------------------------------------------
	|	Total Appointment
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/total-appointment','AppointmentController@totalAppointment');
	/*
	|---------------------------------------------------------------------------
	|	User Information
	|---------------------------------------------------------------------------
	*/
	Route::get('user/info','UserController@userInformation');
	/*
	|---------------------------------------------------------------------------
	|	Update Braider Profile
	|---------------------------------------------------------------------------
	*/
	Route::post('user/profile/update','UserController@update');
	/*
	|---------------------------------------------------------------------------
	|	Braider Change Password
	|---------------------------------------------------------------------------
	*/
	Route::post('user/change-password','UserController@changePassword');
	/*
	|---------------------------------------------------------------------------
	|	Braider Logout
	|---------------------------------------------------------------------------
	*/
	Route::post('user/logout','UserController@logout');

});



