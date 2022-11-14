<?php

namespace App\Helper;

use App\Mail\CreateEmail;
use App\Mail\DelEmail;
use App\Mail\UpdateEmail;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function sendMessage($event,$action)
    {
        switch ($action){
            case 'create':
                Mail::to($event->user->email)->send(new CreateEmail());             //send to user email
                break;
            case 'update':
                Mail::to($event->user->email)->send(new UpdateEmail());             //send to user email
                break;
            case 'del':
                Mail::to($event->user->email)->send(new DelEmail());             //send to user email
                break;
        }
    }
}
