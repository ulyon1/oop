<?php
/**
 * User: Hugo DEVELLY
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain\BankClients;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testABankClientCanMakeADepositInTheirAccountWithoutInitialDeposit(): void
    {
        $deposit = new Money('20.00', new Currency('GBP'));
        $client = new BankClient('Mary', 'Shelley', BankAccount::createBankAccount('GB94OTVJ39068273889791', 'GBP'));
        $client->makeDeposit($deposit);

        $this->assertEquals($deposit, $client->getAccount()->getBalance());
    }

    public function testABankClientCanMakeADepositInTheirAccountWithInitialDeposit(): void
    {
        $deposit = new Money('20.00', new Currency('GBP'));
        $client = new BankClient('William', 'Morris', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '75.00'));
        $client->makeDeposit($deposit);
        $expectedDeposit = $deposit->add(new Money(75, new Currency('GBP')));

        $this->assertEquals($expectedDeposit, $client->getAccount()->getBalance());
    }

    public function testABankClientCanMakeADepositInTheirAccountWithNegativeBalance(): void
    {
        $deposit = new Money('20.00', new Currency('GBP'));
        $client = new BankClient('Vernon', 'Lee', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '-5'));
        $client->makeDeposit($deposit);
        $expectedDeposit = $deposit->add(new Money(-5, new Currency('GBP')));

        $this->assertEquals($expectedDeposit, $client->getAccount()->getBalance());
    }

    public function testABankClientCannotMakeADepositInTheirAccountWithNegativeValue(): void
    {
        $deposit = new Money('-13', new Currency('GBP'));
        $client = new BankClient('Algernon', 'Swinburne', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '-5'));
        $expectedDeposit = new Money(-5, new Currency('GBP'));

        $this->expectException(DepositOperationsException::class);
        $this->expectExceptionMessage('Deposit cannot be below 0.');
        $client->makeDeposit($deposit);
        $this->assertEquals($expectedDeposit, $client->getAccount()->getBalance());
    }

    public function testABankClientCannotMakeADepositInTheirAccountWithZeroValue(): void
    {
        $deposit = new Money(0, new Currency('GBP'));
        $client = new BankClient('Virginia', 'Woolf', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedDeposit = new Money(200, new Currency('GBP'));

        $this->expectException(DepositOperationsException::class);
        $this->expectExceptionMessage('Deposit cannot amount to 0.');
        $client->makeDeposit($deposit);
        $this->assertEquals($expectedDeposit, $client->getAccount()->getBalance());
    }

    public function testABankClientCannotMakeADepositInTheirAccountWithADifferentCurrency(): void
    {
        $deposit = new Money(20, new Currency('USD'));
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedDeposit = new Money(200, new Currency('GBP'));

        $this->expectException(DepositOperationsException::class);
        $this->expectExceptionMessage("Deposit must be of the same currency as the account's balance.");
        $client->makeDeposit($deposit);
        $this->assertEquals($expectedDeposit, $client->getAccount()->getBalance());
    }

    public function testABankClientCanWithdrawMoneyOnTheirAccount(): void
    {
        $amount = new Money(20, new Currency('GBP'));
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedBalance = new Money(180, new Currency('GBP'));
        $withdrawal = $client->withdrawSavings($amount);

        $this->assertEquals($withdrawal, $amount);
        $this->assertEquals($expectedBalance, $client->getAccount()->getBalance());

    }

    public function testABankClientCanWithdrawAllTheirSavings(): void
    {
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedAmount = $client->getAccount()->getBalance();
        $withdrawal = $client->withdrawAllSavings();

        $this->assertEquals($withdrawal, $expectedAmount);
        $this->assertEquals(new Money(0, new Currency('GBP')), $client->getAccount()->getBalance());
    }

    public function testABankClientCanWithdrawMoneyWithinTheirAuthorizedOverlap(): void
    {
        $amount = new Money(300, new Currency('GBP'));
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedBalance = new Money(-100, new Currency('GBP'));

        $withdrawal = $client->withdrawSavings($amount);

        $this->assertEquals($withdrawal, $amount);
        $this->assertEquals($expectedBalance, $client->getAccount()->getBalance());
    }

    public function testABankClientCannotWithdrawMoneyBeyondTheirAuthorizedOverdraft(): void
    {
        $amount = new Money(500, new Currency('GBP'));
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedBalance = $client->getAccount()->getBalance();

        $this->expectException(BalanceOperationsException::class);
        $this->expectExceptionMessage('Authorized overdraft reached.');
        $withdrawal = $client->withdrawSavings($amount);

        $this->assertNull($withdrawal);
        $this->assertEquals($expectedBalance, $client->getAccount()->getBalance());
    }

    public function testABankClientCannotWithdrawAllTheirSavingsWhenNegativeBalance(): void
    {
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '-200'));
        $expectedAmount = $client->getAccount()->getBalance();

        $this->expectException(BalanceOperationsException::class);
        $this->expectExceptionMessage('Current savings below 0.');
        $withdrawal = $client->withdrawAllSavings();

        $this->assertNull($withdrawal);
        $this->assertEquals($expectedAmount, $client->getAccount()->getBalance());

    }

    public function testABankClientCannotWithdrawAnInvalidAMount(): void
    {
        $amount = new Money(-20, new Currency('GBP'));
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedBalance = $client->getAccount()->getBalance();

        $this->expectException(BalanceOperationsException::class);
        $this->expectExceptionMessage('Requested amount must be over 0.');
        $withdrawal = $client->withdrawSavings($amount);

        $this->assertNull($withdrawal);
        $this->assertEquals($expectedBalance, $client->getAccount()->getBalance());

    }

    public function testABankClientCannotWithdrawADifferentCurrencyAmount(): void
    {
        $amount = new Money(20, new Currency('USD'));
        $client = new BankClient('John Maynard', 'Keynes', BankAccount::createBankAccountWithInitialDeposit('GB57CDLM40818850909804', 'GBP', '200'));
        $expectedBalance = $client->getAccount()->getBalance();

        $this->expectException(BalanceOperationsException::class);
        $this->expectExceptionMessage("Requested mount must be of the same currency as the account's balance.");
        $withdrawal = $client->withdrawSavings($amount);

        $this->assertNull($withdrawal);
        $this->assertEquals($expectedBalance, $client->getAccount()->getBalance());

    }

}
