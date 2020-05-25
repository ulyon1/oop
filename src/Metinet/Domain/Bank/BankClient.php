<?php

namespace Metinet\Domain\Bank;

class BankClient
{
    private $firstName;
    private $lastName;
    private $account;

    function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function openAccount(string $currency, int $amount = 0): void
    {
        $this->account = BankAccount::open($amount, $currency);
    }

    public function makeDeposit(int $amount): void
    {
        $this->ensureTheDepositIsOver0($amount);

        $this->account->deposit($amount);
    }

    public function makeWithdrawal(int $amount): void
    {
        $this->account->withdraw($amount);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getAccount(): BankAccount
    {
        return $this->account;
    }

    public function ensureTheDepositIsOver0(int $amount): void
    {
        if( $amount === 0 ){
            throw new \Exception("The deposit amount must be over 0");
        }
    }
}
