<?php

namespace App\Providers;


use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();               //Ovim mjenjam izgled za šaltanje stranica dole  

       

     
   

   /*     //CACHE 
    $ourUsers = Cache::remember('ourUser', now()->addMinutes(0), function () {
        // Dohvati korisnike, ali izbaci duplikate pre kesiranja
        $uniqueUsers = User::orderBy('created_at', 'DESC')
            ->limit(10)
            ->get()
            ->unique('id'); // Pretpostavka da korisnici imaju jedinstvene ID-jeve

        return $uniqueUsers;
    });

    View::share('ourUsers', $ourUsers);*/
}
}
