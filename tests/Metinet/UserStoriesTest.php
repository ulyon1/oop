<?php

namespace Metinet;

use Metinet\Domain\Account\AccountManager;
use Metinet\Domain\Client;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class UserStoriesTest extends TestCase
{
    public function testABankClientCanMakeADepositInHisAccount()
    {
        $newAccount = AccountManager::createNewAccount();
        $client = new Client(
            $newAccount
        );

        $depositValueInEuros = new Money(50, new Currency('USD'));

        AccountManager::makeDepositInAnAccount($depositValueInEuros, $newAccount);

        $this->assertEquals($newAccount->getSumInEuros(), $depositValueInEuros);
    }

    public function testABankClientCanMakeAWithdrawalFromHisAccount()
    {
        $newAccount = AccountManager::createNewAccount();
        $client = new Client(
            $newAccount
        );

        $depositValueInEuros = new Money(100, new Currency('USD'));

        AccountManager::makeDepositInAnAccount($depositValueInEuros, $newAccount);

        $withdrawalValueInEuros = new Money(50, new Currency('USD'));

        AccountManager::makeWithdrawalInAnAccount($withdrawalValueInEuros, $newAccount);

        $this->assertEquals($newAccount->getSumInEuros(), $depositValueInEuros - $withdrawalValueInEuros);

    }

    public function tesABankClientCanSeeTheHistoryOfHisOperations()
    {
        $newAccount = AccountManager::createNewAccount();
        $client = new Client(
            $newAccount
        );

        $depositValueInEuros = new Money(100, new Currency('USD'));

        AccountManager::makeDepositInAnAccount($depositValueInEuros, $newAccount);

        $withdrawalValueInEuros = new Money(50, new Currency('USD'));

        AccountManager::makeWithdrawalInAnAccount($withdrawalValueInEuros, $newAccount);

        $this->assertEquals(count($newAccount->getHistoric()->getOperations()), 2);

    }

}