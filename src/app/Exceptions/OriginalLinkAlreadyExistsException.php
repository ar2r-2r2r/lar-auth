<?php

namespace App\Exceptions;

use Exception;

class OriginalLinkAlreadyExistsException extends Exception
{
    public function errorMessage(){
        $errorMsg='this original Link Aldready Exists';
        return $errorMsg;
    }
}
