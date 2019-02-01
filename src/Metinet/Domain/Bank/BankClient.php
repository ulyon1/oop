<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:13
 */

namespace Metinet\Domain\Bank;

class BankClient
{
    private $bankId;
    private $firstName;
    private $lastName;
    private $account;

    public function __construct(int $bankId, string $firstName, string $lastName, BankAccount $account)
    {
        $this->bankId = $bankId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->account = $account;
    }

    public function getBankId(): int
    {
        return $this->bankId;
    }

    public function getName(): string
    {
        return $this->firstName." ".$this->lastName;
    }

    public function getAccountAmountOfMoney(): Money
    {
        return $this->account->getProvision();
    }
}