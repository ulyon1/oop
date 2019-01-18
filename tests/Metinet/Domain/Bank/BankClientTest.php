<?php

namespace Metinet\Domain\Bank;

use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testABankMustHaveName(): void
    {
        $bankName = "Crédit Agricole";
        $bank = new Bank($bankName);

        $this->assertEquals($bankName, $bank->getName());
    }
}
