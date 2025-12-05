<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        // Vista di login
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Vista di registrazione
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Classe che si occupa di creare l'utente
        Fortify::createUsersUsing(CreateNewUser::class);
    }
}
