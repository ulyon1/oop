<?php

namespace Metinet\Domain\Bank;
use Metinet\Domain\Exceptions\DepositValidator;
use Metinet\Domain\Bank\Account;
use Money\Money;

class Client{

    private $firstname;
    private $lastname;
    private $account;

    public function __construct(string $firstname, string $lastname, Account $account)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->account = $account;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    

}