<?php

namespace Metinet\Domain;

class InvalidOperationType extends \DomainException
{
    public function __construct($operationType)
    {
        parent::__construct(sprintf('We cannot process this operation type, please check syntax : ', $operationType));
    }
}