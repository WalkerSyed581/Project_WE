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
		if ($request->user()->value('role') != $role) {
			switch($request->user()->value('role')){
				case 'p':
					return redirect()->action('PatientController@index');
					break;
				case 'd':
					return redirect()->action('DoctorController@index');
					break;
				case 'hs':

					break;
				case 'sgc':

					break;
				case 'a':

					break;
				default:
					return redirect()->action('PagesController@home');
					break;
			}
        }
        return $next($request);
    }
}
