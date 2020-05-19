<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Input;
use Closure;

class CheckId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {	
		if ($request->isMethod('get') && $request->route('id')) {
			switch(\Auth::user()->role){
				case 'p':
					if($request->route('id') == \Auth::user()->patient->id){
						return $next($request);
					} else {
						return redirect()->action('PatientController@index');
					}
					break;
				case 'd':
					if($request->route('id') == \Auth::user()->doctor->id){
						return $next($request);
					} else {
						return redirect()->action('DoctorController@index');
					}
					break;
				case 'hs':
					if($request->route('id') == \Auth::user()->helpingStaff->id){
						return $next($request);
					} else {
					return redirect()->action('HelpingStaffController@index');
					}
					break;
				case 'sgc':
					if($request->route('id') == \Auth::user()->supportGroupConductor->id){
						return $next($request);
					} else {
						return redirect()->action('SupportGroupController@index');
					}
					break;
				case 'a':
					if($request->route('id') == \Auth::id()){
						return $next($request);
					} else {
						return redirect()->action('AdminController@index');
					}
					break;
				default:
					return redirect()->action('PagesController@home');
					break;
			}
		}

		return $next($request);

    }
}
