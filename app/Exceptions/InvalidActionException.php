<?php

namespace App\Exceptions;

use Exception;

class InvalidActionException extends Exception
{
    public function __construct(string $message = "Error ! Something went wrong !")
    {
        $this->message = $message;
    }
    public function render($request)
    {
        return redirect()->back()->with("failed", $this->message);
    }
}
