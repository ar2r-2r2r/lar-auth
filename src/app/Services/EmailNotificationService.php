<?php
declare(strict_types=1);

namespace App\Services;

use App\Helper\MailHelper;

class EmailNotificationService extends NotificationService
{

    function send($event, $action)
    {
        MailHelper::sendMessage($event, $action);
    }
}