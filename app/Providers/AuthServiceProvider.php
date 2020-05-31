<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

		Gate::define('checkId', function($user,$requested_id) {
			$id = null;
			$role = $user->role;
			switch($role){
				case 'p':
					$id = \Auth::user()->patient->id;
				break;
				case 'd':
					$id = \Auth::user()->doctor->id;
				break;
				case 'sgc':
					$id = \Auth::user()->supportGroupConductor->id;
				break;
				case 'hs':
					$id = \Auth::user()->helpingStaff->id;
				break;
				case 'a':
					$id = \Auth::id();
				break;
			}
			if($requested_id == $id){
				return true;
			} else {
				return false;
			}

		});
    }
}
