<?php

namespace App\Providers;

use App\Events\CreateLinkSuccessful;
use App\Events\DelLinkSuccessful;
use App\Events\UpdateLinkSuccessful;
use App\Listeners\SendCreateConfirmationEmail;
use App\Listeners\SendDelConfirmationEmail;
use App\Listeners\SendUpdateConfirmationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen
        = [
            Registered::class => [
                SendEmailVerificationNotification::class,
            ],
            CreateLinkSuccessful::class => [
                SendCreateConfirmationEmail::class,
            ],
            UpdateLinkSuccessful::class => [
                SendUpdateConfirmationEmail::class,
            ],
            DelLinkSuccessful::class => [
                SendDelConfirmationEmail::class,
            ],
        ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
