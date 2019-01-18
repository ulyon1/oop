<?php

namespace Metinet\Entity;

use Metinet\Validator\BankClientValidator;
use Money\Currency;

class BankClient
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var BankAccount
     */
    private $account;

    public function __construct(string $firstname, string $lastname, BankAccount $account)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->account = $account;

        $this->validate();
    }

    public function makeDeposit(int $amount, Currency $currency)
    {
        $this->account->deposit($amount, $currency);
    }

    public function makeWithdraw(int $amount, Currency $currency)
    {
        $this->account->withdraw($amount, $currency);
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getAccount(): BankAccount
    {
        return $this->account;
    }

    private function validate()
    {
        if (!empty($errors = BankClientValidator::validate($this))) {
            throw new \InvalidArgumentException(array_pop($errors));
        }
    }
}
