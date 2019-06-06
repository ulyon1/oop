<?php

namespace Metinet\Domain\Bank;

use PHPUnit\Framework\TestCase;
use Money\Money;
use Money\Currency;

class BankClientTest extends TestCase
{

    public function testAClientCanBeRegistered(): void
    {
        $firstname = "Fontan";
        $lastname = "Jeremy";
        $phoneNumber = "3310";
        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient($firstname, $lastname, $phoneNumber, $bankAccount);

        $this->assertEquals($firstname, $bankClient->getFirstname());
        $this->assertEquals($lastname, $bankClient->getLastname());
        $this->assertEquals($phoneNumber, $bankClient->getPhoneNumber());
        $this->assertEquals($bankAccount, $bankClient->getBankAccount());
    }

    public function testADepositCanBeDone(): void
    {
        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient("Fontan", "Jeremy", "3310", $bankAccount);
        $bankClient->getBankAccount()->doOperation('deposit', new Money(50, new Currency('EUR')));

        $this->assertEquals($bankClient->getBankAccount()->getBalance(), new Money(50, new Currency('EUR')));
    }

    public function testCanRetrieveSomeSaving(): void
    {
        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient("Fontan", "Jeremy", "3310", $bankAccount);
        $bankClient->getBankAccount()->doOperation('deposit', new Money(50, new Currency('EUR')));
        $bankClient->getBankAccount()->doOperation('withdrawal', new Money(25, new Currency('EUR')));

        $this->assertEquals($bankClient->getBankAccount()->getBalance(), new Money(25, new Currency('EUR')));
    }

    public function testCannotRetrieveTooMuch(): void
    {
        $this->expectException(BalanceTooLow::class);
        $this->expectExceptionMessage('Sorry but you do not have enough money');

        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient("Fontan", "Jeremy", "3310", $bankAccount);
        $bankClient->getBankAccount()->doOperation('deposit', new Money(50, new Currency('EUR')));
        $bankClient->getBankAccount()->doOperation('withdrawal', new Money(60, new Currency('EUR')));
    }

    public function testCannotDoUnallowedOperation(): void
    {
        $this->expectException(OperationNotAllowed::class);
        $this->expectExceptionMessage('Sorry but this type of operation is not allowed. You can type : deposit, withdrawal, checkOperation');

        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient("Fontan", "Jeremy", "3310", $bankAccount);
        $bankClient->getBankAccount()->doOperation('steal', new Money(50000, new Currency('EUR')));
    }

    public function testCannotDoOperationIfDifferentCurrency(): void
    {
        $this->expectException(NotSameCurrency::class);
        $this->expectExceptionMessage('The currency in you account is different from the currency in operation');

        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient("Fontan", "Jeremy", "3310", $bankAccount);
        $bankClient->getBankAccount()->doOperation('deposit', new Money(500, new Currency('USD')));
    }

    public function testSeeAllMyOperations(): void
    {
        $bankAccount = new BankAccount(new Money(0, new Currency('EUR')));
        $bankClient = new BankClient("Fontan", "Jeremy", "3310", $bankAccount);
        $bankClient->getBankAccount()->doOperation('deposit', new Money(500, new Currency('EUR')));
        $bankClient->getBankAccount()->doOperation('deposit', new Money(40, new Currency('EUR')));
        $ops = $bankClient->getBankAccount()->doOperation('checkOperation', new Money(0, new Currency('EUR')));

        $this->assertNotEmpty($ops);
        $this->assertEquals(4,count((array)$ops));
    }
}
