<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::group(['middleware'=>'auth'],function(){
/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
	Route::get('/dashboard', DashBoardController::class)->name('dashboard');
/*
|--------------------------------------------------------------------------
| Category , Product , Company , User ,Purchase ,Location
|--------------------------------------------------------------------------
*/
	Route::resources([
		'company' => 'CompanyController',
		'user' => 'UserController',
		'services' => 'ServiceController'
	]);
/*
|--------------------------------------------------------------------------
|  Company 
|--------------------------------------------------------------------------
*/
	Route::post('company/delete-all',"CompanyController@deleteAll")->name("company.destroy.all");
/*
|--------------------------------------------------------------------------
|  Company 
|--------------------------------------------------------------------------
*/
	Route::post('services/delete-all',"ServiceController@deleteAll")->name("services.destroy.all");
/*
|--------------------------------------------------------------------------
|  User 
|--------------------------------------------------------------------------
*/
	Route::post('User/delete-all',"UserController@deleteAll")->name("user.destroy.all");
/*
|--------------------------------------------------------------------------
|  Profile
|--------------------------------------------------------------------------
*/
	Route::get('profile',"ProfileController")->name("profile.index");
	Route::post('profile',"ProfileController@update")->name("profile.update");
});