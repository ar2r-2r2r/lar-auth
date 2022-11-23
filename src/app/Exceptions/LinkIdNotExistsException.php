<?php

namespace App\Exceptions;

use Exception;

class LinkIdNotExistsException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}