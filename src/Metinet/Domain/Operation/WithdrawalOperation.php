<?php

namespace Metinet\Domain\Operation;


class WithdrawalOperation extends Operation
{
    public function __construct($amount, $balance)
    {
        parent::__construct($amount, $balance);
    }
}