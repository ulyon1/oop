<?php

namespace Metinet\Domain\Account;

use Metinet\Domain\Historic;
use Money\Currency;
use Money\Money;

class Account
{
    private $sum;
    private $historic;

    public function __construct()
    {
        $this->sum = new Money(0, new Currency('USD'));
        $this->historic = new Historic();
    }

    public function getSum(): Money
    {
        return $this->sum;
    }

    public function getHistoric()
    {
        return $this->historic;
    }

    public function makeADeposit(Money $deposit): void
    {
        $newValue = new Money(
            ($this->sum->getAmount()) + $deposit->getAmount(),
            new Currency('USD')
        );
        $this->sum = $newValue;
    }

    public function makeAWithdrawal(Money $withdrawal): void
    {
        $newValue = new Money(
            $this->sum->getAmount() - $withdrawal->getAmount(),
            new Currency('USD')
        );
        $this->sum -= $withdrawal;
    }
}