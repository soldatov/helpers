<?php

namespace Soldatov\Helpers\Exceptions;

use LogicException;
use Throwable;

class BadVarTypeException extends LogicException
{
    public function __construct($type, array $types, $code = 0, Throwable $previous = null)
    {
        $types = implode(', ', $types);
        $message = "Var type {$type} is not on the list of allowed types [{$types}]";

        parent::__construct($message, $code, $previous);
    }
}