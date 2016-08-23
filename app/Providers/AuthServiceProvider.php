<?php

namespace App\Providers;


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
        \App\Ad::class => \App\Policies\AdPolicy::class,

    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);


        //habilidades configuradas
        $gate->define('read-ad', function ($user, $ad) {
            return $user->id == $ad->user_id;
        });  //@can('edit-ad);

        $gate->define('edit-ad', function ($user, $ad) {  //estas son eliminadas cuando hay una policy
            return $user->id == $ad->user_id;
        });

        $gate->define('show-ad', function ($user, $ad) {
            return $user->owns($ad);
        });


    }
}
