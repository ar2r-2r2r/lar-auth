<?php
declare(strict_types=1);

namespace App\Services;

use App\Helper\TgHelper;

class TelegramNotificationService extends NotificationService
{

    function send($event, $action)
    {
        TgHelper::sendMessage($event, $action);
    }
}