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
});

Route::middleware(['auth','role:d'])->group(function () {
	Route::get('/doctor','DoctorController@index');
});

Route::middleware(['auth','role:hs'])->group(function () {

});

Route::middleware(['auth','role:sgc'])->group(function () {
	
});

Route::middleware(['auth','role:a'])->group(function () {
	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

