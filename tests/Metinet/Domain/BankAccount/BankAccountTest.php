<?php

namespace Metinet\Domain\BankAccount;

use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    public function testClientCanDeposeMoneyOnHisAccount(): void
    {
        $depositAmountInCentsOfEuro = 85000;

        $deposit = BankAccount::depose($depositAmountInCentsOfEuro);

        $this->assertEquals($depositAmountInCentsOfEuro, $deposit->getDepositAmount());
    }

    public function testClientCanWithdrawMoneyOnHisAccount(): void
    {
        $withdrawAmountInCentsOfEuro = 50000;
        $deposit = BankAccount::depose($withdrawAmountInCentsOfEuro);
        $this->assertEquals($withdrawAmountInCentsOfEuro, $deposit->getDepositAmount());
    }

    public function testClientCanSeeHisAccountHistory(): void
    {
        $this->assertTrue(true);
    }

    public function testClientCantWithdrawMoreMoneyThanHeHasOnHisAccount(): void
    {
        $this->assertTrue(true);
    }

    public function t(): void
    {
        $this->assertTrue(true);
    }
}
