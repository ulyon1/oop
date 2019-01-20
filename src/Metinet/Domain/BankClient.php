<?php

namespace Metinet\Domain;


class BankClient
{
    private $firstname;
    private $lastname;
    private $email;
    private $account;

    public function __construct(string $firstname, string $lastname, string $email, Account $account)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->account = $account;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }


}