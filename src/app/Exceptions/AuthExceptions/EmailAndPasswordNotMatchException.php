<?php

namespace App\Exceptions\AuthExceptions;

use Exception;

class EmailAndPasswordNotMatchException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}