<?php

namespace App\Listeners;

use App\Mail\CreateEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCreateConfirmationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $linkModel=$event->linkModel;

        Mail::to(auth()->user()->email)->send(new CreateEmail($linkModel));
    }
}
