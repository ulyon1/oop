<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 11:03
 */

namespace Metinet\Domain;


use Money\Money;

class History
{
    private $operations = [];

    private function __construct()
    {
    }

    public static function startRegisteringOperations()
    {
        return new self();
    }

    public function addADepositAction(Money $deposit, Account $account, \DateTimeImmutable $date):void
    {
        $this->operations[] = ['DEPOSIT',$date, $deposit->getAmount(), $account->getBalance()];
    }

    public function addAWithdrawalAction( Money $deposit, Account $account, \DateTimeImmutable $date):void
    {
        $this->operations[] = ['WITHDRAWAL',$date, $deposit->getAmount(), $account->getBalance()];

    }

    public function getOperations():array
    {
        return $this->operations;
    }


}