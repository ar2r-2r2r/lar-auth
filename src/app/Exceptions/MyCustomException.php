<?php

namespace App\Exceptions;

use Exception;

class MyCustomException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
