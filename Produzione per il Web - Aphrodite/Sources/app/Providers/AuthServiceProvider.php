<?php

namespace ASD_Aphrodite\Providers;

use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'ASD_Aphrodite\Model' => 'ASD_Aphrodite\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
