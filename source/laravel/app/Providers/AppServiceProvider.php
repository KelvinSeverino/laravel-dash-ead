<?php

namespace App\Providers;

use App\Repositories\Eloquent\{
    AdminRepository,
    UserRepository,
};
use App\Repositories\{
    AdminRepositoryInterface,
    UserRepositoryInterface
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Bind das interfaces, se trocar o ORM para outro, mudar aqui, usando conceito da Inversao de Dependencia
        //singleton gera o New Class() uma vez e armazena para ser reutilizado posteriormente
        $this->app->singleton(
            AdminRepositoryInterface::class,
            AdminRepository::class,
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
