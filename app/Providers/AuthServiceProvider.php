<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define("isSuperAdmin", function ($user) {
            return $user->role->name == "superadmin";
        });
        Gate::define("isAdmin", function ($user) {
            return $user->role->name == "admin";
        });
        Gate::define("isCashier", function ($user) {
            return $user->role->name == "cashier";
        });
        Gate::define("isWarehouseKeeper", function ($user) {
            return $user->role->name == "warehouse keeper";
        });
    }
}
