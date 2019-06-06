<?php

namespace Metinet\Domain\Bank;


class BalanceTooLow extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Sorry but you do not have enough money');
    }
}