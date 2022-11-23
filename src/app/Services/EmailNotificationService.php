<?php
declare(strict_types=1);

namespace App\Services;

use App\Helper\MailHelper;
use App\Models\User;

class EmailNotificationService extends NotificationService
{

    function send($userId, $action)
    {
        $email = User::where('id', $userId)->get('email');
        MailHelper::sendMessage($email, $action);
    }
}