<?php

namespace App\Listeners;

use App\Mail\DelEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDelConfirmationEmail implements ShouldQueue
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
        Mail::to(auth()->user()->email)->send(new DelEmail());                  //send to user mail
        Mail::to("hello@example.com")->send(new DelEmail());              //send to admin mail
    }
}
