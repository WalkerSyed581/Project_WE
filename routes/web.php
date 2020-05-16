<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','PagesController@home');
Route::get('/login','PagesController@login');
Route::get('/about','PagesController@about');
Route::get('/register','PagesController@register');

Route::middleware(['auth','role:p'])->group(function () {
	Route::get('/patient','PatientController@index');
	Route::get('/patient/getAppointment/{id}','PatientController@getAppointment');
	Route::get('/patient/bill/{id}','PatientController@showBill');
	Route::get('/patient/joinSupportGroup/{id}','PatientController@joinSupportGroup');
	Route::get('/patient/labReport/{id}','PatientController@labReport');
});

Route::middleware(['auth','role:d'])->group(function () {
	Route::get('/doctor','DoctorController@index');
	// Route::get('/patient','DoctorController@getAppointment');
	// Route::get('/patient','DoctorController@showBill');
});


Route::middleware(['auth','role:hs'])->group(function () {

});

Route::middleware(['auth','role:sgc'])->group(function () {
	
});

Route::middleware(['auth','role:a'])->group(function () {
	Route::get('/admin','AdminController@index');
	Route::get('/admin/registerUser','AdminController@showRegisterForm');
	Route::get('/admin/registerRole/{user_id}/{role}','AdminController@showRoleForm');

	//Post Links
	Route::post('/admin/registerRole','AdminController@registerRoleData');
	Route::post('/admin/registerUser','UsersController@store');

	Route::post('/doctor/store','DoctorController@store');
	Route::post('/supportGroupConductor/store','SupportGroupConductorController@store');
	Route::post('/helpingStaff/store','HelpingStaff@store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

