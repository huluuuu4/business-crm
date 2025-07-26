<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        // dd('Gate is being checked'); // Add this line for the test
         // This rule now grants access to both 'admin' and 'superadmin'
    Gate::define('is-admin', function (User $user) {
        return in_array($user->role, ['admin', 'superadmin']);
    });
    }
}