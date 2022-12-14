<?php
declare(strict_types=1);

namespace App\Helper;


use App\Notifications\TelegramNotification;


class TgHelper
{
    public static function sendMessage($user, $action)
    {

        switch ($action) {
            case 'create':
                $user->notify(new TelegramNotification('created!'));             //send to user email
                break;
            case 'update':
                $user->notify(new TelegramNotification('update!'));             //send to user email
                break;
            case 'del':
                $user->notify(new TelegramNotification('deleted!'));             //send to user email
                break;
        }

    }

}
