<?php

namespace App\Helper;


use App\Models\User;
use App\Notifications\TelegramNotification;

use Illuminate\Support\Facades\DB;


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
