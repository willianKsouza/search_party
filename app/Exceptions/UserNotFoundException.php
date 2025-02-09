<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct(string $message, int $code = 0) 
    {
        parent::__construct($message, $code);
    }
}
