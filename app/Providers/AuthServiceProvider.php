<?php

namespace sisClientes\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'sisClientes\Model' => 'sisClientes\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', function($user){

            return $user->perfil =='1';
        });

        $gate->define('isSupervisor', function($user){
            
            return $user->perfil =='3';
            

        });

        $gate->define('isAgente', function($user){

            return $user->perfil =='2';
        });       

        //
    }
}
