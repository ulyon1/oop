<?php

namespace Metinet\Domain\Bank;

use Money\Currency;

class BankClient
{
    private $id;
    private $account;

    public static function createClient(): self
    {
        return new self(uniqid());
    }

    public function __construct(string $id, BankAccount $account = null)
    {
        $this->id = $id;
        $this->account = $account;
    }

    public function addBankAccount(Currency $currency): BankAccount
    {
        if(!empty($this->account)){
            throw new \Exception('User already has a bank account');
        }

        $this->account = BankAccount::createAccount($this, $currency);

        return $this->account;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return BankAccount
     */
    public function getAccount(): BankAccount
    {
        return $this->account;
    }
}