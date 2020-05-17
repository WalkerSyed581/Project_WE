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
	Route::get('/patient/{id}/appointmentForm','PatientController@showAppointmentForm');
	Route::post('/patient/addAppointment','DoctorAppointmentController@store');
	Route::get('/patient/removeDoctorAppointment/{id}','DoctorAppointmentController@destroy');
	Route::get('/patient/removeLabAppointment/{id}','LabAppointmentController@destroy'); //To be done i.e. does not work
	Route::get('/patient/{id}/supportGroupList','PatientController@showSupportGroups');
	Route::get('/patient/{id}/joinSupportGroup/{supportGroup_id}','PatientController@joinSupportGroup');
	Route::get('/patient/{id}/leaveSupportGroup/{supportGroup_id}','PatientController@leaveSupportGroup');	

	//Links to be added to the sidebar according to site design
	Route::get('/patient/{id}/labReport/{labAppointment_id}','LabAppointmentController@showLabReport');
	Route::get('/patient/{id}/{appointment_id}/prescription','PatientController@showPrescription');
	Route::get('/patient/{id}/appointmentArchive','PatientController@appoinmentArchive');
	Route::get('/patient/{id}/currentAdmission','PatientController@showCurrentAdmission');
	Route::get('/patient/{id}/allAdmissions','PatientController@showAllAdmissions');
	Route::get('/patient/{id}/bill','PatientController@showBill'); //To Be Done


	
});

Route::middleware(['auth','role:d'])->group(function () {
	Route::get('/doctor','DoctorController@index');
	// Route::get('/patient','DoctorController@getAppointment');
	// Route::get('/patient','DoctorController@showBill');
});


Route::middleware(['auth','role:hs'])->group(function () {
	Route::get('/doctor','DoctorController@index');
});

Route::middleware(['auth','role:sgc'])->group(function () {
	
});

Route::middleware(['auth','role:a'])->group(function () {
	Route::get('/admin','AdminController@index');
	Route::get('/admin/registerUser','AdminController@showRegisterForm');
	Route::get('/admin/registerRole/{user_id}/{role}','AdminController@showRoleForm');

	//To Be Done
	Route::get('/admin/supportGroup/add','AdminController@addSupportGroup');
	// Route::get('/admin/supportGroup/remove/{supportGroup_id}','SupportGroupController@destroy');



	//Post Links
	Route::post('/admin/registerRole','AdminController@registerRoleData');
	Route::post('/admin/registerUser','UsersController@store');

	Route::post('/patient/store','PatientController@store');
	Route::post('/doctor/store','DoctorController@store');
	Route::post('/supportGroupConductor/store','SupportGroupConductorController@store');
	Route::post('/helpingStaff/store','HelpingStaffController@store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/appointment/{id}/cancel','AppointmentController@destroy');
Route::get('/supportGroups/add/{user_id}','SupportGroupController@addUser');

