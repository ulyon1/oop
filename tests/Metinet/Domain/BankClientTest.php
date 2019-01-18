<?php

namespace Metinet\Domain;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testBankClientCanMakeDeposit() : void
    {
        $savings = Money::EUR(100);
        $bankClient = new BankClient('Firstname'
                                    , 'LastName'
                                    , 'test@metin.net'
                                    , new Account($savings, new Currency('EUR')));
        $amount = new Money(50, new Currency('EUR'));
        $bankClient->getAccount()->deposit($amount);
        $this->assertEquals($savings->add($amount), $bankClient->getAccount()->getSavings());
    }

    public function testBankClientCannotMakeOperationWithDifferentCurrencyAccount()
    {
        $this->expectException(ErrorsCurrency::class);
        $this->expectExceptionMessage('Bank Client cannot make a deposit with a wrong currency !');

        $savings = Money::EUR(100);
        $bankClient = new BankClient('Firstname'
            , 'LastName'
            , 'test@metin.net'
            , new Account($savings, new Currency('EUR')));
        $bankClient->getAccount()->deposit(Money::USD(50));
        $bankClient->getAccount()->withdrawal(Money::USD(50));
        $this->assertEquals($savings, $bankClient->getAccount()->getSavings());
    }

    public function testBankClientCanMakeWithdrawal() : void
    {
        $savings = Money::EUR(200);
        $bankClient = new BankClient('Firstname'
            , 'LastName'
            , 'test@metin.net'
            , new Account($savings, new Currency('EUR')));
        $amount = new Money(50, new Currency('EUR'));
        $bankClient->getAccount()->withdrawal($amount);
        $this->assertEquals($savings->subtract($amount), $bankClient->getAccount()->getSavings());
    }

    public function testBankClientCanSeeHistoryOfOperations() : void
    {
        $bankClient = new BankClient('Firstname'
            , 'LastName'
            , 'test@metin.net'
            , new Account(Money::EUR(200), new Currency('EUR')));
        $bankClient->getAccount()->deposit(Money::EUR(150));
        $bankClient->getAccount()->withdrawal(Money::EUR(50));
        $lesOperations = $bankClient->getAccount()->getHistory()->all();
        $this->assertCount(2, $lesOperations);
    }

    public function testBankClientCannotExceedHisRightOfDiscovery()
    {
        //TODO
    }

}