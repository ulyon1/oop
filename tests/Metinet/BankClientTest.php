<?php

namespace Metinet;

use Metinet\Domain\Bank\BankAccount;
use Metinet\Domain\Bank\BankAccountExceptions;
use Metinet\Domain\Bank\BankClient;
use Money\Currency;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testABankClientCantMakeDepositInAccountWithoutBalance(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage('A client cannot make a deposit without balance');

        $balance = -10;
        BankClient::register("John","Doe");

        $bankAccount = new BankAccount($balance,new Currency("USD"));
        $bankAccount->makeADeposit($balance,new Currency("USD"));

    }

    public function testABankClientCantMakeDepositInAccountWithDifferentCurrency(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage('A client cannot make a deposit with different currencies');

        $balance = 10;
        BankClient::register("John","Doe");

        $bankAccount = new BankAccount($balance,new Currency("USD"));
        $bankAccount->makeADeposit($balance,new Currency("EUR"));

    }

    public function testABankClientCantMakeAWithdrawalWithNegativeBalance(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage('A client cannot make a withdrawal with negative balance');

        BankClient::register("John","Doe");
        $balance = -20;
        $amount = 100;

        $bankAccount = new BankAccount($balance,new Currency("USD"));
        $bankAccount->withdrawMoney($balance,$amount,new Currency("USD"));
    }

    public function testABankClientCantMakeAWithdrawalWithBiggerAmount(): void
    {
        $this->expectException(BankAccountExceptions::class);
        $this->expectExceptionMessage('A client cannot make a withdrawal with less amount than balance');

        BankClient::register("John","Doe");
        $balance = 200;
        $amount = 300;

        $bankAccount = new BankAccount($balance,new Currency("USD"));
        $bankAccount->withdrawMoney($balance,$amount,new Currency("USD"));
    }


}
