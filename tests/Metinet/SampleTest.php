<?php

namespace Metinet;

use PHPUnit\Framework\TestCase;
use Metinet\Domain\Bank\Account;
use Metinet\Domain\Bank\Client;
use Metinet\Domain\Bank\Operation;

class SampleTest extends TestCase
{
    public function testEnsurePhpUnitIsWorkingProperly(): void
    {
        $this->assertTrue(true);
    }

    public function testCreateBankAccount(): void
    {
        $account = new Account(new Money(500, new Currency('EUR')), new Money(0, new Currency('EUR')));
    }

    public function makeDepositToBankAccount(): void
    {
        
    }

    public function makeNegativeValueDeposit(): void
    {
        
    }
}
