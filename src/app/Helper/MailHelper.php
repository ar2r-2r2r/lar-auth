<?php
declare(strict_types=1);

namespace App\Helper;

use App\Mail\CreateEmail;
use App\Mail\DelEmail;
use App\Mail\UpdateEmail;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function sendMessage($event, $action)
    {
        switch ($action) {
            case 'create':
                Mail::to($event)
                    ->send(new CreateEmail());             //send to user email
                break;
            case 'update':
                Mail::to($event)
                    ->send(new UpdateEmail());             //send to user email
                break;
            case 'del':
                Mail::to($event)
                    ->send(new DelEmail());             //send to user email
                break;
        }
    }
}
