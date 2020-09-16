<?php

namespace Soldatov\Helpers\Exceptions;

use InvalidArgumentException;
use Throwable;

class BadParameterException extends InvalidArgumentException
{
    /** @var string $paramName */
    private $paramName;

    /** @var string $methodName */
    private $methodName;

    public function __construct(
        string $message,
        string $paramName = '',
        string $methodName = '',
        $code = 0,
        Throwable $previous = null
    ) {
        $this->paramName = $paramName;
        $this->methodName = $methodName;

        if (!empty($paramName)) {
            $message .= " Parameter name: {$paramName}.";
        }

        if (!empty($methodName)) {
            $message .= " Method name: {$methodName}.";
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getParamName(): string
    {
        return $this->paramName;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }
}