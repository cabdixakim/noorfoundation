<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


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

        //create Gate for plan update
        Gate::define('edit-plan',  function($user){
            
             if($user->plan->semester_end <= Carbon::now()->format('y-m-d')){
                 return true;
             }
        });
        // show edit avatar
        Gate::define('show-edit-avatar',  function($user){
             
            if (auth()->user()->user_type == 'sponsor') {
               if(Route::is('sponsor.index')){
                  return true;
               }
            }
            if (auth()->user()->user_type == 'student') {
                if(Route::is('student.index')){
                    return true;
                }
             }
    
        });
    }
}
