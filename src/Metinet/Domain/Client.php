<?php

namespace Metinet\Domain;

use Metinet\Domain\Account\Account;

class Client
{
    private $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }
}