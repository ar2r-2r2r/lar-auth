<?php

namespace App\Providers;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Services\UserService;
use App\Repositories\UserRepository;
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
            return new AuthService(new AuthRepository());
        });
        $this->app->bind(UserServiceInterface::class, function () {
            return new UserService(new UserRepository());
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
