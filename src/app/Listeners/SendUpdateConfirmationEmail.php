<?php

namespace App\Listeners;

use App\Mail\UpdateEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUpdateConfirmationEmail implements ShouldQueue
{
    use Queueable;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->email)->send(new UpdateEmail());               //send to user mail
        Mail::to("hello@example.com")->send(new UpdateEmail());           //send to admin mail
    }
}
