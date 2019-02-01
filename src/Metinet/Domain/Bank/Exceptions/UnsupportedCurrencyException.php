<?php

namespace Metinet\Domain\Bank\Exceptions;

use Throwable;

class UnsupportedCurrencyException extends \Exception
{
    public function __construct(string $currency = "", int $code = 0, Throwable $previous = null)
    {
        $message = "Unsupported currency exception : ".$currency;

        parent::__construct($message, $code, $previous);
    }
}