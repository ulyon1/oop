<?php

namespace Metinet\Domain\Bank;

use Money\Money;
use Metinet\Domain\Bank\Account;
use Money\Currency;


class Account{

    private $balance;
    private $minimumBalance;

    public function __construct(Money $balance)
    {
        $this->balance = Money::EUR($balance);
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getMinimumBalance()
    {
        return $this->minimumBalance;
    }

    public function makeDeposit(Money $depositValue, Account $account)
    {
        $depositExceptons = new DepositExceptions();
        
        if($depositExceptons::makeNegativeDeposit($depositValue))
        {
            return new Deposit(Money $depositValue, Account $account, new DateTime('now'));
            $this->balance->add($depositValue);
        }
        
    }

    public function makeWithdrawal(Money $withdrawalValue, Account $account)
    {
        $withdrawalExceptions = new WithdrawalExceptions();
        if($withdrawalExceptions::checkCurrency($withdrawalValue, $this->balance))
        {
            $minimumBalance = $this->getMinimumBalance();
            if($withdrawalExceptions::checkBankAccountAmmount($account->getBalance(), $account->getMinimumBalance(), $withdrawalValue))
            {
                $this->balance->subtract($withdrawalValue);
            }
        
        }
    
    }
}