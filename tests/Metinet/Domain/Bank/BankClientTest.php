<?php

namespace Metinet\Domain\Bank;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testAddAccountToClient(): void
    {
        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        $this->assertEquals($client->getAccount(), new BankAccount($client, new Money(0, new Currency("USD"))));
    }

    public function testCantMakeADepositOfANegativeAmountOfMoney(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage("Can't make a deposit of a negative amount of money");

        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        BankOperation::makeDeposit($client, new Money(-1, new Currency("USD")));
    }

    public function testCantWithdrawANegativeAmountOfMoney(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage("Can't withdraw a negative amount of money");

        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        BankOperation::makeWithdraw($client, new Money(-1, new Currency("USD")));
    }

    public function testCantMakeADepositWithADifferentCurrency(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage("Can't make a deposit with different currencies");

        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        BankOperation::makeDeposit($client, new Money(1, new Currency("YEN")));
    }

    public function testCantWithdrawIfAccountHasANegativeAmountOfMoney(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage("Can't withdraw on an account with a negative amount of money");

        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        BankOperation::makeWithdraw($client, new Money(1, new Currency("USD")));
        BankOperation::makeWithdraw($client, new Money(1, new Currency("USD")));
    }

    public function testBankOperationWithdraw(): void
    {
        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        $date = (new \DateTimeImmutable())->format("d-m-Y");
        $withdraw = BankOperation::makeWithdraw($client, new Money(1, new Currency("USD")));

        $this->assertEquals("Withdraw : 1 | Balance : -1 | Date : ".$date , (string) $withdraw);
    }

    public function testBankOperationDeposit(): void
    {
        $client = BankClient::createClient();
        $client->addBankAccount(new Currency('USD'));
        $date = (new \DateTimeImmutable())->format("d-m-Y");
        $deposit = BankOperation::makeDeposit($client, new Money(10, new Currency("USD")));

        $this->assertEquals("Deposit : 10 | Balance : 10 | Date : ".$date , (string) $deposit);
    }
}
