<?php

namespace Metinet\Exception;

class NotSufficientAccountBalanceException extends \UnderflowException
{
    public function __construct($balance, $amount)
    {
        parent::__construct(sprintf('You can\'t retrieve %s from your account as you have only %s', $amount, $balance));
    }
}
