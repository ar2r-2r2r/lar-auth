<?php

namespace App\Exceptions;

use Exception;

class OriginalLinkAlreadyExistsException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}