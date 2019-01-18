<?php

namespace Metinet\Domain\Bank;


class BankAccount
{
    private $provision;
    // il faudrait un objet AccountOperation avec date, etc.., mais pas le temps
    private $operations;

    public static function create($currency, $amount){
        return new self(new Money($currency, $amount));
    }

    public function __construct(Money $amount)
    {
        $this->provision = $amount;
        $this->operations = [];
    }

    public function getProvision(): Money
    {
        return $this->provision;
    }

    public function getProvisionCurrency(): string
    {
        return $this->provision->getCurrency();
    }

    public function getProvisionAmount(): int
    {
        return $this->provision->getAmountInLowestUnity();
    }

    public function deposit(Money $amount): void
    {
        $this->provision->add($amount);
        $this->operations[] = time('now')." : Deposit => ".$amount->getAmountFormatedForCurrency($this->provision->getCurrency())."\n"
            ."Your balance is now : ".$this->provision->getAmountFormatedForCurrency($this->provision->getCurrency())."\n\n";
    }

    public function withdraw(Money $amount): void
    {
        $this->provision->substract($amount);
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function getLatestOperations(): array
    {
        return $this->operations/*->getLatestOperations()*/;
    }
}