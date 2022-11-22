<?php

namespace App\Helper;

use App\Notifications\TelegramNotification;


class TgHelper
{
    public static function sendMessage($event, $action)
    {
        switch ($action) {
            case 'create':
                $event->user->notify(new TelegramNotification('created!'));             //send to user email
                break;
            case 'update':
                $event->user->notify(new TelegramNotification('update!'));             //send to user email
                break;
            case 'del':
                $event->user->notify(new TelegramNotification('deleted!'));             //send to user email
                break;
        }

    }

}
