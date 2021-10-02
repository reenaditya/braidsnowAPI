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
	|	get Customer
	|---------------------------------------------------------------------------
	*/
	Route::get('customer/index','MyCustomerController@index');
	/*
	|---------------------------------------------------------------------------
	|	Total Appointment
	|---------------------------------------------------------------------------
	*/
	Route::get('appointment/total-appointment','AppointmentController@totalAppointment');

	/*
	|---------------------------------------------------------------------------
	|	upload Portfoliio 
	|---------------------------------------------------------------------------
	*/
	Route::post('portfolio/store','PortfolioController@store');

	/*
	|---------------------------------------------------------------------------
	|	get Portfoliio 
	|---------------------------------------------------------------------------
	*/
	Route::post('portfolio/index','PortfolioController@index');
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

Route::group(['prefix' => 'customer','namespace' => 'API\Customer'], function() {
	/*
	|---------------------------------------------------------------------------
	|	Register Customer
	|---------------------------------------------------------------------------
	*/
	Route::post('register','Auth\RegisterController@register');

	Route::post('login','Auth\LoginController@login');

	
});
/*
|---------------------------------------------------------------------------
|	Customer Auth Routes
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'customer','namespace' => 'API\Customer','middleware' => 'auth:api'], function() {

	/*
	|---------------------------------------------------------------------------
	|	Favourite Customer
	|---------------------------------------------------------------------------
	*/

	Route::get('favourite','FavouriteController@getFovourite');

	/*
	|---------------------------------------------------------------------------
	|	get profile information
	|---------------------------------------------------------------------------
	*/

	Route::get('profile/edit','ProfileController@getInformation');

	/*
	|---------------------------------------------------------------------------
	|	update profile
	|---------------------------------------------------------------------------
	*/
	Route::post('profile/update','ProfileController@update');

	/*
	|---------------------------------------------------------------------------
	|	Customer Change Password
	|---------------------------------------------------------------------------
	*/
	Route::post('profile/change-password','ProfileController@changePassword');

	/*
	|---------------------------------------------------------------------------
	|	Customer logout
	|---------------------------------------------------------------------------
	*/
	Route::post('logout','ProfileController@logout');

});

/*
|---------------------------------------------------------------------------
|	Customer Auth Routes
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'homepage','namespace' => 'API'], function() {

	/*
	|---------------------------------------------------------------------------
	|	Homepage Braider list
	|---------------------------------------------------------------------------
	*/

	Route::get('top-braider','HomepageController@getTopBraider');

	Route::get('service', 'HomepageController@getService');
});



