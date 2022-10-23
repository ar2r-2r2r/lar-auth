<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Interfaces\AuthRepositoryInterface;
//use App\Repositories\AuthRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

//    public function register()
//    {
//
//        $this->app->bind(AuthRepositoryInterface::class, function () {
//            return new AuthRepository();
//        });
//
//    }
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
