<?php

namespace Metinet\Domain;

class InvalidOperationValue extends \DomainException
{
    public function __construct($operationValue)
    {
        parent::__construct(sprintf('Invalid operation, please check sum of the operation : ', $operationValue));
    }
}