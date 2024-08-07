<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void            
    {
       

       
        Gate::define('admin', function (User $user): bool {
            return (bool) $user->is_admin;
        });        


       
    }
}
