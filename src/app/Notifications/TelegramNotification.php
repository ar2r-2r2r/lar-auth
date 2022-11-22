<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use TelegramNotifications\Messages\TelegramMessage;
use TelegramNotifications\TelegramChannel;

class TelegramNotification extends Notification
{
    use Queueable;

    private string $msg;

    public function __construct(string $msg)
    {
        $this->msg = $msg;
    }

    public function via()
    {
        return [TelegramChannel::class];
    }

    public function toTelegram()
    {
        return (new TelegramMessage())->text($this->msg);
    }
}
