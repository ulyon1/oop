<?php

namespace Metinet\Domain\Bank;

class BankAccount
{
    //TODO: mettre la class Money à la place
    private $amount;
    private $currency;
    private $maxOverdraft = 0;

    function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function open(int $amount, string $currency): self
    {
        return new self($amount, $currency);
    }

    public function deposit(int $amount): void
    {
        $this->amount += $amount;
    }

    public function withdraw(int $amount): void
    {
        $this->ensureCanMakeWithdrawal($amount);

        $this->amount -= $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function ensureCanMakeWithdrawal(int $amount): void
    {
        if( $amount > ($this->amount + $this->maxOverdraft) ){
            throw new \Exception("You have not enough money in your account");
        }
    }
}
