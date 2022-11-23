<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Services\EmailNotificationService;
use App\Services\TelegramNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreateConfirmationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $emailNotificationService = new EmailNotificationService();
        $telegramNotificationService = new TelegramNotificationService();
        $emailNotificationService->send($event->userId, 'create');
        $telegramNotificationService->send($event->userId, 'create');
    }
}
