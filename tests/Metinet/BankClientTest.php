<?php

namespace Metinet;

use PHPUnit\Framework\TestCase;

class BankClient extends TestCase
{
    public function testABankClientCanMakeADeposit(): void
    {
        $client = new BankClient("Kévin","Faurie");

    }

    public function testABankClientCanMakeAWithdrawalFromHisAccount(): void
    {

    }

    public function testABankClientCanSeeHisHistory(): void
    {

    }
}
