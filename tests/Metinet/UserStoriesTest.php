<?php

namespace Metinet;

use Metinet\Domain\Account;
use Metinet\Domain\Client;
use PHPUnit\Framework\TestCase;

class UserStoriesTest extends TestCase
{
    public function testABankClientCanMakeADepositInHisAccount()
    {
        $client = new Client(
            new Account()
        );

        $depositValueInEuros = 50;

        $client->getAccount()->addDepositInEurosToSumInEuros($depositValueInEuros);

        $this->assertEquals($client->getAccount()->getSumInEuros(), $depositValueInEuros);
    }

    public function testABankClientCanMakeAWithdrawalFromHisAccount()
    {
        $client = new Client(
            new Account()
        );

        $depositValueInEuros = 100;

        $client->getAccount()->addDepositInEurosToSumInEuros($depositValueInEuros);

        $withdrawalValueInEuros = 50;

        $client->getAccount()->makeAWithdrawalInEuros($withdrawalValueInEuros);

        $this->assertEquals($client->getAccount()->getSumInEuros(), $depositValueInEuros - $withdrawalValueInEuros);
    }

    public function tesABankClientCanSeeTheHistoryOfHisOperations()
    {
        $client = new Client(
            new Account()
        );

        $depositValueInEuros = 100;

        $client->getAccount()->addDepositInEurosToSumInEuros($depositValueInEuros);

        $withdrawalValueInEuros = 50;

        $client->getAccount()->makeAWithdrawalInEuros($withdrawalValueInEuros);

        $this->assertEquals($client->getAccount()->getSumInEuros(), $depositValueInEuros - $withdrawalValueInEuros);
    }


}