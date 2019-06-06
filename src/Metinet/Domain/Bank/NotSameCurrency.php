<?php

namespace Metinet\Domain\Bank;


class NotSameCurrency extends \DomainException
{
    public function __construct()
    {
        parent::__construct('The currency in you account is different from the currency in operation');
    }
}