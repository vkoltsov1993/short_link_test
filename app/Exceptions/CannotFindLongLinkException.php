<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CannotFindLongLinkException extends Exception
{
    public function __construct($shortLink)
    {
        $message = 'The is no long link for ' . $shortLink;
        parent::__construct($message, 404);
    }
}
