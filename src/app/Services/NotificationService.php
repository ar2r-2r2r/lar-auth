<?php

namespace App\Services;

use App\Helper\MailHelper;
use App\Helper\TgHelper;

class NotificationService
{
    public function __construct()
    {
    }

    public static function email($event, $action)
    {
        MailHelper::sendMessage($event, $action);
    }

    public static function telegram($event, $action)
    {
        TgHelper::sendMessage($event, $action);
    }
}
