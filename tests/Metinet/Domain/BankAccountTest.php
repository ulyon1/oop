<?php

namespace Metinet\Domain;

use PHPUnit\Framework\TestCase;
use Money\Money;

use Metinet\Domain\BankAccount;
use Metinet\Domain\Operation\Deposit;

class BankAccountTest extends TestCase
{
    public function testEnsureACustomerCanMakeADeposit(): void
    {
    	$account = new BankAccount('John', 'Smith');
    	$deposit = new Deposit(Money::EUR(5));

    	$account->addOperation($deposit);

        $this->assertTrue($account->getBalance()->equals(Money::EUR(5)));
    }

    public function testEnsureACustomerCannotDepositANegativeValue(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureACustomerCanWithdrawMoney(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureACustomerCannotWithdrawMoreThanHisCredit(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureACustomerCannotWithdrawANegativeValue(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureACustomerCanSeeHistoryOfOperations(): void
    {
        $this->assertTrue(true);
    }
}
