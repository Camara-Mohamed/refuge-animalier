<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-animals', function (User $user): bool {
            return $user->isAdmin() || $user->isVolunteer();
        });

        Gate::define('manage-adoptions', function (User $user): bool {
            return $user->isAdmin() || $user->isVolunteer();
        });

        Gate::define('manage-messages', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::define('manage-volunteers', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::define('manage-reports', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::define('manage-data', function (User $user): bool {
            return $user->isAdmin() || $user->isVolunteer();
        });
    }
}
