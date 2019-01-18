<?php

namespace Metinet\Bank;

use Metinet\Domain\Bank\BankAccount;
use Metinet\Domain\Bank\BankClient;
use Metinet\Domain\Bank\Deposit;
use Metinet\Domain\Bank\Withdrawal;
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

        $money = Money::EUR(100);
        $deposit = Deposit::create($money);
        $bankAccount->makeDeposit($deposit);

        $this->assertEquals($deposit, $bankAccount->getLastDeposit());
    }

    public function testAsABankClientMakeAWithdrawalInMyAccount(): void
    {
        $firstName = 'John';
        $lastName = 'Doe';

        $bankClient = BankClient::createClient($firstName, $lastName);

        $bankAccount = BankAccount::createAccount($bankClient);

        $money = Money::EUR(100);
        $deposit = Deposit::create($money);
        $bankAccount->makeDeposit($deposit);


        $money = Money::EUR(50);
        $withdrawal = Withdrawal::create($money);
        $bankAccount->makeWithdrawal($withdrawal);

        $this->assertEquals($withdrawal, $bankAccount->getLastWithdrawal());
    }
}
