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

Route::middleware(['auth','role:p','checkId'])->group(function () {
	Route::get('/patient','PatientController@index');
	Route::get('/patient/{id}/appointmentForm','PatientController@showAppointmentForm');
	Route::post('/patient/addAppointment','DoctorAppointmentController@store');
	Route::get('/patient/removeDoctorAppointment/{id}','DoctorAppointmentController@destroy');
	Route::get('/patient/removeLabAppointment/{id}','LabAppointmentController@destroy');
	Route::get('/patient/{id}/supportGroupList','PatientController@showSupportGroups');
	Route::get('/patient/{id}/joinSupportGroup/{supportGroup_id}','PatientController@joinSupportGroup');
	Route::get('/patient/{id}/leaveSupportGroup/{supportGroup_id}','PatientController@leaveSupportGroup');	

	//Sidebar Links
	Route::get('/patient/{id}/labReport/{labAppointment_id}','LabAppointmentController@showLabReport');
	Route::get('/patient/{id}/prescription/{appointment_id}','PatientController@showPrescription');
	Route::get('/patient/{id}/appointmentArchive','PatientController@appoinmentArchive');
	Route::get('/patient/{id}/currentAdmission','PatientController@showCurrentAdmission');
	Route::get('/patient/{id}/allAdmissions','PatientController@showAllAdmissions');
	Route::get('/patient/{id}/bill','PatientController@showBill');

	

	
});

Route::middleware(['auth','role:d','checkId'])->group(function () {
	Route::get('/doctor','DoctorController@index');
	Route::get('/doctor/{id}/approveAppointment/{appointment_id}','DoctorAppointmentController@approveAppointment');
	
	Route::get('/doctor/{id}/viewPrescription/{appointment_id}','DoctorController@viewPrescription');
	Route::post('/doctor/addPrescription','DoctorController@addPrescription');
	Route::post('/doctor/updatePrescription','DoctorController@updatePrescription');

	Route::get('/doctor/{id}/addDrugs/{prescription_id}/{number_of_drugs}','DoctorController@showDrugsForm');
	Route::post('/doctor/addDrugs','DoctorController@addDrugs');

	Route::get('/doctor/{id}/addLabAppointment/{appointment_id}','DoctorController@showLabAppointmentForm');
	Route::post('/doctor/addLabAppointment','LabAppointmentController@store');

	Route::get('/doctor/{id}/doctorAppointment','DoctorController@addAppointment');
	Route::get('/doctor/{id}/doctorAppointment/{appointment_id}','DoctorController@showAppointment');
	Route::post('/doctor/addDoctorAppointment','DoctorAppointmentController@store');
	Route::post('/doctor/updateDoctorAppointment','DoctorController@updateAppointment');

	Route::get('/doctor/{id}/admitPatient/{patient_id}','DoctorController@showAdmitForm');
	Route::post('/doctor/admitPatient','AdmissionController@store');
});

Route::middleware(['auth','role:d','checkId'])->group(function () {
});

Route::middleware(['auth','role:hs','checkId'])->group(function () {
	Route::get('/helpingStaff','HelpingStaffController@index');
	Route::post('/helpingStaff/updateDoctorAppointment','DoctorController@updateAppointment');

	Route::get('/helpingStaff/{id}/labReport/{labAppointment_id}','HelpingStaffController@addLabReport');
	Route::post('/helpingStaff/updateLabReport','HelpingStaffController@updateLabReport');
	Route::post('/helpingStaff/addLabReport','HelpingStaffController@storeLabReport');


	Route::get('/helpingStaff/{id}/labAppointment/{labAppointment_id}','HelpingStaffController@showLabAppointment');
	Route::post('/helpingStaff/labAppointment','HelpingStaffController@updateLabAppointment');

	Route::get('/helpingStaff/{id}/updateAdmission/{admission_id}','HelpingStaffController@showAdmitForm');
	Route::post('/helpingStaff/updateAdmission/{admission_id}','AdmissionController@edit');

	Route::get('/helpingStaff/{id}/addWard','HelpingStaffController@showWardForm');
	Route::post('/helpingStaff/addWard','HelpingStaffController@storeWard');
	Route::get('/helpingStaff/{id}/editWard/{ward_id}','HelpingStaffController@showWard');
	Route::post('/helpingStaff/editWard','HelpingStaffController@updateWard');

	Route::get('/helpingStaff/{id}/addTest','HelpingStaffController@showTestForm');
	Route::post('/helpingStaff/addTest','HelpingStaffController@storeTest');
	Route::get('/helpingStaff/{id}/editTest/{test_id}','HelpingStaffController@showTest');
	Route::post('/helpingStaff/editTest','HelpingStaffController@updateTest');


});

Route::middleware(['auth','role:sgc','checkId'])->group(function () {
	Route::get('/sgc','SupportGroupController@index');
	Route::get('/sgc/{id}/supportGroup/{supportGroup_id}/members','SupportGroupController@members');
});

Route::middleware(['auth','role:a','checkId'])->group(function () {
	Route::get('/admin','AdminController@index');
	Route::get('/admin/{id}/registerUser','AdminController@showRegisterForm');
	Route::get('/admin/{id}/registerRole/{user_id}/{role}','AdminController@showRoleForm');

	//To Be Done
	Route::get('/admin/{id}/supportGroup/add','AdminController@addSupportGroup');
	// Route::get('/admin/supportGroup/remove/{supportGroup_id}','SupportGroupController@destroy');

	//Post Links
	Route::post('/admin/registerRole','AdminController@registerRoleData');
	Route::post('/admin/registerUser','UsersController@store');

	Route::post('/patient/store','PatientController@store');
	Route::post('/doctor/store','DoctorController@store');
	Route::post('/supportGroupConductor/store','SupportGroupConductorController@store');
	Route::post('/helpingStaff/store','HelpingStaffController@store');
});

Route::middleware(['auth'])->group(function () {

	Route::get('/user/{id}/patient/{patient_id}/showProfile','DoctorController@patientInfo');

	Route::get('/user/{id}/showUserProfile','UsersController@showProfile');
	Route::post('/user/editProfile/{id}','UsersController@update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/appointment/{id}/cancel','AppointmentController@destroy');
Route::get('/supportGroups/add/{user_id}','SupportGroupController@addUser');

