<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:48
 */

namespace Metinet\Domain\Bank\Exceptions;


class UnsupportedCurrencyConversionException extends \Exception
{
    public function __construct(string $currencyTo = "", string $currencyFrom = "", int $code = 0, Throwable $previous = null)
    {
        $message = "Unsupported currency conversion (\"".$currencyFrom."\" to \"".$currencyTo."\" ";

        parent::__construct($message, $code, $previous);
    }
}