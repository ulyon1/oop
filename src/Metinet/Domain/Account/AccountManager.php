<?php

namespace Metinet\Domain\Account;

use Money\Money;
use Metinet\Domain\Operation\DepositOperation;
use Metinet\Domain\Operation\WithdrawalOperation;

class AccountManager
{

    public static function createNewAccount()
    {
        return new Account();
    }

    public static function makeDepositInAnAccount(Money $deposit, Account $account): void
    {
        /**
         * We could check here if the transaction is valid
         */
        $account->makeADeposit($deposit);
        $account->getHistoric()->saveOperation(
            new DepositOperation(
                $account->getSum(),
                $deposit
            ),
            $deposit
        );

    }

    public static function makeWithdrawalInAnAccount(Money $withdrawal, Account $account): void
    {
        /**
         * We could check here if the transaction is valid
         */
        $account->makeAWithdrawal($withdrawal);
        $account->getHistoric()->saveOperation(
            new WithdrawalOperation(
                $account->getSum(),
                $withdrawal
            ),
            $$withdrawal
        );
    }

}