<?php

namespace App\Listeners;

use App\Mail\CreateEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCreateConfirmationEmail implements ShouldQueue
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
        Mail::to($event->email)->send(new CreateEmail());             //send to user email
        Mail::to("hello@example.com")->send(new CreateEmail());         //send to admin email
    }
}
