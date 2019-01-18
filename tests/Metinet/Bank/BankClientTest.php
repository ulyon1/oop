<?php

namespace Metinet\Bank;

use Metinet\Domain\Bank\BankAccount;
use Metinet\Domain\Bank\BankClient;
use Metinet\Domain\Bank\Deposit;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testAsABankClientMakeADepositInMyAccount(): void
    {
        $firstName = 'John';
        $lastName = 'Doe';

        $bankClient = BankClient::createClient($firstName, $lastName);

        $bankAccount = BankAccount::createAccount($bankClient);

        $money = Money::EUR('100');
        $deposit = Deposit::createDeposit($money);
        $bankAccount->makeDeposit($deposit);

        $this->assertEquals($deposit, $bankAccount->getLastDeposit());
    }
}
