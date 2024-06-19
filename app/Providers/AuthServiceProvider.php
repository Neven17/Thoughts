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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void            
    {
        // Gate => premission | simple role


        //Role
        Gate::define('admin', function (User $user): bool {
            return (bool) $user->is_admin;
        });         //cekirati ce je li user admin i jel ovlasten biti na stranci iadmin, funkcija cekira admin usera i usera koji je prijavljen


       
    }
}
