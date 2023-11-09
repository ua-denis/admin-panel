<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\News;
use App\Models\User;
use App\Policies\NewsPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        News::class => NewsPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access-admin', function ($user) {
            return $user->is_admin;
        });

        Gate::define('access-profile', function ($user) {
            return !$user->is_admin;
        });
    }
}
