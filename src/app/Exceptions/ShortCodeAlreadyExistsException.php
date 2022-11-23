<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ShortCodeAlreadyExistsException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }

    public function changeRecreate(bool $recreate): bool
    {
        if ($recreate) {
            return true;
        }

        return false;
    }
}