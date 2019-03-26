<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin',function($user){
          return $user->type === 'admin';
        });
        Gate::define('isGateEntry',function($user){
          return $user->type === 'gateEntry';
        });
        Gate::define('isYarnStore',function($user){
          return $user->type === 'yarnStore';
        });
        Gate::define('isGreyFabric',function($user){
          return $user->type === 'greyFabric';
        });
        Gate::define('isFinishFabric',function($user){
          return $user->type === 'finishFabric';
        });
        Gate::define('isDyesAndChemical',function($user){
          return $user->type === 'dyesAndchemical';
        });
        Gate::define('isTrimsStore',function($user){
          return $user->type === 'trimsStore';
        });

        Passport::routes();
    }
}
