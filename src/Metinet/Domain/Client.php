<?php

namespace Metinet\Domain;

class Client
{
    // private $id;
    private $account;

    public function __construct(Account $account)
    {
        // $this->id = uniqid();
        $this->account = $account;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }
}