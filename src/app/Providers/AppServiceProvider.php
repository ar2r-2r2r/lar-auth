<?php

namespace App\Providers;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\AuthRepositoryInterface;

use App\Repositories\AuthRepository;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, function () {
            return new AuthService();
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
