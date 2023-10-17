<?php
namespace App\Providers;

use Illuminate\Support\Facades\Gate; // Import Gate
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // ...
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Definisikan Gate untuk isAdmin atau isHRD
        Gate::define('isAdminOrHRD', function ($user) {
            return in_array($user->hak, [7, 10]); // Sesuaikan dengan nilai hak yang sesuai
        });
    }
}