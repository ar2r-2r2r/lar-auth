<?php

namespace App\Providers;

use App\Factories\LinkModelFactory\LinkModelFactory;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\LinkServiceProxyInterface;
use App\Interfaces\UserServiceInterface;
use App\Repositories\AuthRepository;
use App\Repositories\LinkRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\CacheService;
use App\Services\LinkService;
use App\Services\LinkServiceProxy;
use App\Services\UserService;
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
        $this->app->bind(LinkServiceProxyInterface::class, function () {
            return new LinkServiceProxy(new LinkService(new LinkRepository(),
                new LinkModelFactory()), new CacheService());
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
