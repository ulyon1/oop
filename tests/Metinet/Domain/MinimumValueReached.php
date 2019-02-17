<?php

namespace Metinet\Domain;

class InvalidValueReached extends \DomainException
{
    public function __construct($accountBalance)
    {
        parent::__construct(sprintf('Account balance too low to make withdrawal : ', $accountBalance));
    }
}