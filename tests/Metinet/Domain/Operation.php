<?php

namespace Metinet\Domain;
use Money\Currency;
use Money\Money;

class Operation
{
    private $operationType;
    private $operationValue;
    private $operationDate;

    public function __construct(string $operationType, Money $operationValue, Date $operationDate)
    {
        $this->$operationType = $operationType;
        $this->$operationValue = $operationValue;
        $this->$operationDate = $operationDate;
    }

    public function getOperationType() : string
    {
        switch($this->operationType)
        {
            case 'withdrawal':
                return 'withdrawal';
            break;

            case 'deposit':
                return 'deposit';
            break;

            default:
                throw new InvalidOperationType($this->operationType);

        }
    }

    public function getOperationValue() : float
    {
        return $this->operationValue;
    }

    public function getOperationDate() : Date
    {
        return $this->operationDate;
    }

    public function __toString(): string
    {
        return  Date::fromAtomFormat($this->operationDate). " - " . $this->operationType. " of " . $this->operationValue . " " .$this->operationValue->getCode();
    }

    
}