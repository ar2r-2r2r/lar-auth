<?php

namespace App\Exceptions\LinkExceptions;

use Exception;

class LinkIdNotExistsException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}