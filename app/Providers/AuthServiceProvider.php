<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("utilisateurs", function (User $user) {
            return $user->hasModule("utilisateurs");
        });

        Gate::define("administration", function (User $user) {
            return $user->hasModule("administration");
        });

        Gate::define("enseignants", function (User $user) {
            return $user->hasModule("enseignants");
        });

        Gate::define("caisses", function (User $user) {
            return $user->hasModule("caisses");
        });

        Gate::define("eleves", function (User $user) {
            return $user->hasModule("eleves");
        });

        Gate::define("evaluations", function (User $user) {
            return $user->hasModule("evaluations");
        });

        Gate::define("consultation", function (User $user) {
            return $user->hasModule("consultation");
        });
    }
}
