<?php

namespace App\Services;

use App\Mail\CreateEmail;
use App\Mail\DelEmail;
use App\Mail\UpdateEmail;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function __construct()
    {
    }
    public static function email($event,$action){
        switch ($action){
            case 'create':
                Mail::to($event->email)->send(new CreateEmail());             //send to user email
                break;
            case 'update':
                Mail::to($event->email)->send(new UpdateEmail());             //send to user email
                break;
            case 'del':
                Mail::to($event->email)->send(new DelEmail());             //send to user email
                break;
        }

    }
}
