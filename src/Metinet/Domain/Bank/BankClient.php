<?php

namespace Metinet\Domain\Bank;


class BankClient
{
    private $firstname;
    private $lastname;
    private $phoneNumber;
    private $bankAccount;

    public function __construct(string $firstname, string $lastname, string $phoneNumber, BankAccount $bankAccount)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phoneNumber = $phoneNumber;
        $this->bankAccount = $bankAccount;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getBankAccount(): BankAccount
    {
        return $this->bankAccount;
    }

}