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
        $this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('The withdraw amount must be greater than 0');

        $account = new BankAccount('John', 'Smith');
    	$withdraw = new Withdraw(Money::EUR(0));

    	$account->addOperation($withdraw);
    }

    public function testEnsureACustomerCannotWithdrawAnAmountExpressedInOtherCurrency(): void
    {
        $this->expectException(OperationFailed::class);
    	$this->expectExceptionMessage('You cannot withdraw an amount expressed in another currency');

        $account = new BankAccount('John', 'Smith', Money::USD(50));
    	$withdraw = new Withdraw(Money::EUR(30));

    	$account->addOperation($withdraw);
    }

    public function testEnsureACustomerCanSeeHistoryOfOperations(): void
    {
        $account = new BankAccount('John', 'Smith');

        $account ->addOperation(new Deposit(Money::EUR(30)))
        	->addOperation(new Withdraw(Money::EUR(20)))
        	->addOperation(new Deposit(Money::EUR(700)));

        $data = $account->getoperationsData();
        $this->assertEquals($data[0]['type'], 'deposit');
        $this->assertTrue($data[0]['amount']->equals(Money::EUR(30)));
        $this->assertTrue($data[0]['balanceAfter']->equals(Money::EUR(30)));

        $this->assertEquals($data[1]['type'], 'withdraw');
        $this->assertTrue($data[1]['amount']->equals(Money::EUR(20)));
        $this->assertTrue($data[1]['balanceAfter']->equals(Money::EUR(10)));

        $this->assertEquals($data[2]['type'], 'deposit');
        $this->assertTrue($data[2]['amount']->equals(Money::EUR(700)));
        $this->assertTrue($data[2]['balanceAfter']->equals(Money::EUR(710)));
    }
}
