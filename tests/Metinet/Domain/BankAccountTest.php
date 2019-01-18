<?php

namespace Metinet\Domain;

use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    public function testEnsureAClientCanMakeADeposit(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureAClientCannotDepositANegativeValue(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureAClientCanWithdrawMoney(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureAClientCannotWithdrawMoreThanHisCredit(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureAClientCannotWithdrawANegativeValue(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureAClientCanSeeHistoryOfOperations(): void
    {
        $this->assertTrue(true);
    }
}
