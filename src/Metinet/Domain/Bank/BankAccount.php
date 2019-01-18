<?php

namespace Metinet\Domain\Bank;


use Money\Currency;
use Money\Money;

class BankAccount
{
    private $client;
    private $balance;

    public static function createAccount(BankClient $client, Currency $currency): self
    {
        return new self($client, new Money(0, $currency));
    }

    public function __construct(BankClient $client, Money $balance)
    {
        $this->client = $client;
        $this->balance = $balance;
    }

    public function deposit(Money $money): void
    {
        if(!$money->isSameCurrency($this->balance)){
            throw BankAccountExceptions::cantMakeADepositWithDifferentCurrencies();
        }

        if($money->isNegative()){
            throw BankAccountExceptions::cantMakeADepositOfANegativeAmountOfMoney();
        }

        $this->balance = $this->balance->add($money);
    }

    public function withdraw(Money $money): void
    {
        if($money->isNegative()){
            throw BankAccountExceptions::cantWithdrawANegativeAmountOfMoney();
        }

        if($this->balance->isNegative()){
            throw BankAccountExceptions::cantWithdrawOnAnAccountWithANegativeAmountOfMoney();
        }

        $this->balance = $this->balance->subtract($money);
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

}