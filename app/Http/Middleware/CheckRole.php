<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {

		if (\Auth::user()->role != $role) {
			switch(\Auth::user()->role){
				case 'p':
					return redirect()->action('PatientController@index');
					break;
				case 'd':
					return redirect()->action('DoctorController@index');
					break;
				case 'hs':
					return redirect()->action('HelpingStaffController@index');
					break;
				case 'sgc':
					return redirect()->action('SupportGroupController@index');
					break;
				case 'a':
					return redirect()->action('AdminController@index');
					break;
				default:
					return redirect()->action('PagesController@home');
					break;
			}
        }
        return $next($request);
    }
}
