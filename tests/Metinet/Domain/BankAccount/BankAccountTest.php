<?php

namespace tests\Metinet\Domain\BankAccount;

use PHPUnit\Framework\TestCase;
use Metinet\Domain\BankAccount\BankAccount;

class BankAccountTest extends TestCase
{
    public function testClientCanDeposeMoneyOnHisAccount(): void
    {
        $initialDepositInCents = "100000";
        $account = BankAccount::createAccount($initialDepositInCents);
        $depositAmountInCents = 85000;

        $account->makeDeposit($depositAmountInCents);

        $this->assertEquals($depositAmountInCents, $account->getDepositAmount());
    }

    public function testClientCanWithdrawMoneyOnHisAccount(): void
    {

    }

    public function testClientCanSeeHisAccountHistory(): void
    {

    }

    public function testClientCantWithdrawMoreMoneyThanHeHasOnHisAccount(): void
    {

    }

    public function t(): void
    {

    }
}
