<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Services\EmailNotificationService;
use App\Services\TelegramNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDelConfirmationEmail implements ShouldQueue
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

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $emailNotificationService = new EmailNotificationService();
        $telegramNotificationService = new TelegramNotificationService();
        $emailNotificationService->send($event, 'del');
        $telegramNotificationService->send($event, 'del');
    }
}
