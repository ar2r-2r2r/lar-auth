<?php
declare(strict_types=1);

namespace App\Services;

use App\Helper\TgHelper;
use App\Models\User;

class TelegramNotificationService extends NotificationService
{

    function send($userId, $action)
    {
        $user = User::where('id', $userId)->first();
        TgHelper::sendMessage($user, $action);
    }
}