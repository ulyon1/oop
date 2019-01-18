<?php

namespace Metinet\Domain\Bank;


use Metinet\Domain\Date;
use Money\Money;

class BankAccount
{
    private $balance;
    private $operations;

    public function __construct(Money $balance)
    {
        $this->balance = $balance;
        $this->operations = [];
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function getOperations()
    {
        return $this->operations;
    }

    public function doOperation(string $type, Money $amount)
    {
        if (!$this->checkIfCurrencyIsSame($amount)) {
            throw new NotSameCurrency();
        }
        if($type == "checkOperation")
        {
            return $this->getOperations();
        } else {
            $newBalance = $this->calculateNewBalance($type,$amount);
            $operation = new BankOperation($type, $amount, Date::fromAtomFormat("Y-m-d"), $newBalance);
            $this->operations = $operation;
            $this->balance = $newBalance;
        }
    }

    private function calculateNewBalance(string $type, Money $amount)
    {
        if ($type == 'deposit') {
            return $this->balance->add($amount);
        } else if ($type == 'withdrawal') {
            if (!$this->checkIfBalanceIsGreaterThanWithdrawal($amount)) {
                throw new BalanceTooLow();
            }
            return $this->balance->subtract($amount);
        } else {
            return $this->balance;
        }
    }

    private function checkIfCurrencyIsSame(Money $amount)
    {
        return $amount->isSameCurrency($this->balance);
    }

    private function checkIfBalanceIsGreaterThanWithdrawal(Money $amount)
    {
        return $this->balance->greaterThan($amount);
    }

}