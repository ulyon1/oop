<?php

namespace Metinet\Bank;

use Metinet\Domain\Bank\BankAccount;
use Metinet\Domain\Bank\BankClient;
use Metinet\Domain\Bank\Deposit;
use Metinet\Domain\Bank\UnableToCreateBankClient;
use Metinet\Domain\Bank\Withdrawal;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testAsABankClientIWantToMakeADepositInMyAccount(): void
    {
        $firstName = 'John';
        $lastName = 'Doe';

        $bankClient = BankClient::createClient($firstName, $lastName);

        $bankAccount = BankAccount::createAccount($bankClient);

        $money = Money::EUR(100);
        $deposit = Deposit::create($money);
        $bankAccount->makeDeposit($deposit);

        $this->assertEquals($deposit, $bankAccount->getLastDeposit());
    }

    public function testABankClientCannotBeCreatedWithEmptyFirstName():void
    {
        $this->expectException(UnableToCreateBankClient::class);
        $this->expectExceptionMessage('Bank client cannot be created with empty first name');

        $firstName = '';
        $lastName = 'Doe';

        BankClient::createClient($firstName, $lastName);
    }

    public function testABankClientCannotBeCreatedWithEmptyLastName():void
    {
        $this->expectException(UnableToCreateBankClient::class);
        $this->expectExceptionMessage('Bank client cannot be created with empty last name');

        $firstName = 'John';
        $lastName = '';

        BankClient::createClient($firstName, $lastName);
    }

    public function testAsABankClientIWantToMakeAWithdrawalInMyAccount(): void
    {
        $firstName = 'John';
        $lastName = 'Doe';

        $bankClient = BankClient::createClient($firstName, $lastName);

        $bankAccount = BankAccount::createAccount($bankClient);

        $money = Money::EUR(100);
        $deposit = Deposit::create($money);
        $bankAccount->makeDeposit($deposit);


        $money = Money::EUR(50);
        $withdrawal = Withdrawal::create($money);
        $bankAccount->makeWithdrawal($withdrawal);

        $this->assertEquals($withdrawal, $bankAccount->getLastWithdrawal());
    }

    public function testAsABankClientIWantToCheckOperationsOnMyAccount(): void
    {
        $firstName = 'John';
        $lastName = 'Doe';

        $bankClient = BankClient::createClient($firstName, $lastName);

        $bankAccount = BankAccount::createAccount($bankClient);


        $bankAccount->makeDeposit(Deposit::create(Money::EUR(100)));
        $this->assertEquals($bankAccount->getBalance(), Money::EUR(100));

        $bankAccount->makeDeposit(Deposit::create(Money::EUR(300)));
        $this->assertEquals($bankAccount->getBalance(), Money::EUR(400));

        $bankAccount->makeWithdrawal(Withdrawal::create(Money::EUR(30)));
        $this->assertEquals($bankAccount->getBalance(), Money::EUR(370));

        $bankAccount->makeDeposit(Deposit::create(Money::EUR(250)));
        $this->assertEquals($bankAccount->getBalance(), Money::EUR(620));

        $bankAccount->makeWithdrawal(Withdrawal::create(Money::EUR(100)));
        $this->assertEquals($bankAccount->getBalance(), Money::EUR(520));

    }
}
