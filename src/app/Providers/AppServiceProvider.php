<?php

namespace App\Providers;

use App\Factories\LinkModelFactory\LinkModelFactory;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\LinkServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\LinkModel;
use App\Repositories\AuthRepository;
use App\Repositories\LinkRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\LinkService;
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
        $this->app->bind(LinkServiceInterface::class, function () {
            return new LinkService(new LinkRepository(), new LinkModelFactory());
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
