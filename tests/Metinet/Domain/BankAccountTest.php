<?php

namespace Metinet\Domain;

use PHPUnit\Framework\TestCase;
use Money\Money;

use Metinet\Domain\BankAccount;
use Metinet\Domain\Operation\Deposit;
use Metinet\Domain\Operation\Withdraw;
use Metinet\Domain\Operation\OperationFailed;

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
    	$this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('You can\'t deposit a negative amount');

        $account = new BankAccount('John', 'Smith');
    	$deposit = new Deposit(Money::EUR(-5));

    	$account->addOperation($deposit);
    }

    public function testEnsureACustomerCannotDepositAZeroValue(): void
    {
    	$this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('The deposit amount must be greater than 0');

        $account = new BankAccount('John', 'Smith');
    	$deposit = new Deposit(Money::EUR(0));

    	$account->addOperation($deposit);
    }

    public function testEnsureACustomerCannotDepositAnAmountExpressedInOtherCurrency(): void
    {
    	$this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('You cannot deposit an amount expressed in another currency');

        $account = new BankAccount('John', 'Smith', Money::USD(0));
    	$deposit = new Deposit(Money::EUR(50));

    	$account->addOperation($deposit);
    }

    public function testEnsureACustomerCanWithdrawMoney(): void
    {
        $account = new BankAccount('John', 'Smith', Money::EUR(50));
    	$withdraw = new Withdraw(Money::EUR(5));

    	$account->addOperation($withdraw);

        $this->assertTrue($account->getBalance()->equals(Money::EUR(45)));
    }

    public function testEnsureACustomerCannotWithdrawMoreThanHisCredit(): void
    {
    	$this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('Your account credit is too low to withdraw this amount');

        $account = new BankAccount('John', 'Smith', Money::EUR(20));
    	$withdraw = new Withdraw(Money::EUR(30));

    	$account->addOperation($withdraw);
    }

    public function testEnsureACustomerCannotWithdrawANegativeValue(): void
    {
        $this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('You can\'t withdraw a negative amount');

        $account = new BankAccount('John', 'Smith');
    	$withdraw = new Withdraw(Money::EUR(-5));

    	$account->addOperation($withdraw);
    }

    public function testEnsureACustomerCannotWithdrawAZeroValue(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureACustomerCannotWithdrawAnAmountExpressedInOtherCurrency(): void
    {
        $this->assertTrue(true);
    }

    public function testEnsureACustomerCanSeeHistoryOfOperations(): void
    {
        $this->assertTrue(true);
    }
}
