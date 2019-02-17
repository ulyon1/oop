<?php

namespace Metinet\Domain;

use PHPUnit\Framework\TestCase;
use Money\Currency;
use Money\Money;
include("Domain/Account");
include("Domain/Client");
include("Domain/Operation");
include("Domain/Date");


class SampleTest extends TestCase
{
    
    public function testEnsurePhpUnitIsWorkingProperly(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function addAClientTest(): void
    {
        $client = new Client('Elliot', 'Edwards', new Account(new Money(541, new Currency('EUR')), new Money(250, new Currency('EUR'))));
        $this->assertTrue(true);
    }
    /** @test */
    public function makeWithdrawalTest(): void
    {
        $client = new Client('Elliot', 'Edwards', new Account(new Money(541, new Currency('EUR')), new Money(250, new Currency('EUR'))));
        foreach($client->getAccounts() as $account)
        {
            $account->makeWithdrawal(new Operation('withdrawal', new Money(500, new Currency('EUR')), Date::fromAtomFormat('2019-02-01')));
        }
        
    }
    /** @test */
    public function makeDepositTest() : void
    {
        $client = new Client('Elliot', 'Edwards', new Account(new Money(541, new Currency('EUR')), new Money(250, new Currency('EUR'))));
        foreach($client->getAccounts() as $account)
        {
            $account->makeDeposit(new Operation('deposit', new Money(500, new Currency('EUR')), Date::fromAtomFormat('2019-02-01')));
        }
    }
    /** @test */
    public function invalidOperationTest() : void
    {
        $client = new Client('Elliot', 'Edwards', new Account(new Money(541, new Currency('EUR')), new Money(250, new Currency('EUR'))));
        foreach($client->getAccounts() as $account)
        {
            $account->makeWithdrawal(new Operation('sdfsdshrtfg', new Money(500, new Currency('EUR')), Date::fromAtomFormat('2019-02-01')));
        }
    }
    /** @test */
    public function minimumValueReachedTest() : void
    {
        $client = new Client('Elliot', 'Edwards', new Account(new Money(0, new Currency('EUR')), new Money(100, new Currency('EUR'))));
        foreach($client->getAccounts() as $account)
        {
            $account->makeWithdrawal(new Operation('withdrawal', new Money(500, new Currency('EUR')), Date::fromAtomFormat('2019-02-01')));
        }
    }
    /** @test */
    public function viewAccountOperationsHistoryTest() : void
    {
        $client = new Client('Elliot', 'Edwards', new Account(new Money(541, new Currency('EUR')), new Money(250, new Currency('EUR'))));
        foreach($client->getAccounts() as $account)
        {
            $account->getAccountOperationsHistory();
        }
    }
    
}
