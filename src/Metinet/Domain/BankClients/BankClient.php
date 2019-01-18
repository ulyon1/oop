<?php
/**
 * User: Hugo DEVELLY
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain\BankClients;


use Money\Money;

class BankClient
{
    private $firstName;
    private $surname;
    private $account;

    /**
     * BankClient constructor.
     * @param $firstName
     * @param $surname
     * @param $account
     */

    public function __construct(string $firstName, string $surname, BankAccount $account)
    {
        $this->firstName = $firstName;
        $this->surname = $surname;
        $this->account = $account;
    }

    public function makeDeposit(Money $sum)
    {
        $this->account->deposit($sum);
    }

    public function withdrawSavings(Money $amount): Money
    {
        $withdrawal = $this->account->withdraw($amount);
        return $withdrawal;
    }

    public function withdrawAllSavings(): Money
    {
        $withdrawal = $this->account->withdraw();
        return $withdrawal;
    }

    /**
     * @return BankAccount
     */
    public function getAccount()
    {
        return $this->account;
    }



}