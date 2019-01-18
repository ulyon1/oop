<?php

namespace Metinet;


use Metinet\Domain\Bank\BankAccount;
use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    public function testABankAccountCanBeCreated(){
        $currency = '€';
        $amount = 50000;

        $bankAccount = BankAccount::create($currency, $amount);

        $this->assertEquals($currency, $bankAccount->getProvisionCurrency());
        $this->assertEquals($amount, $bankAccount->getProvisionAmount());
    }

    // je n'ai pas eu le temps de faire plus de tests
    // >phpunit --bootstrap vendor/autoload.php tests/Metinet/BankAccountTest
}