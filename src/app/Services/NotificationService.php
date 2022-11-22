<?php
declare(strict_types=1);

namespace App\Services;

abstract class NotificationService
{
    public function __construct()
    {
    }

    abstract function send($event, $action);

}
