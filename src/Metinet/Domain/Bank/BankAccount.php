<?php

namespace Metinet\Domain\Bank;

class BankAccount
{
    //TODO: mettre la class Money à la place
    private $amount;
    private $currency;

    function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function deposit(int $amount): void
    {
        $this->amount += $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
