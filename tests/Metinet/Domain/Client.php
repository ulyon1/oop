<?php

namespace Metinet\Domain;
use Money\Currency;
use Money\Money;


class Client
{
    private $firstName;
    private $lastName;
    private $accounts;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->accounts = [];
    }

    public function addAccount(Account $account) : void
    {
        $this->accounts[] = $account;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    public function getAccounts() : array
    {
        return $this->accounts;
    }

    public function __toString(): string
    {
        return $this->firstName. " - " . $this->lastName . " - ". $this->getAccounts();
    }
}