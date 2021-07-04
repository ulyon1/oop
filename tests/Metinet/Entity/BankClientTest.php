<?php

namespace Metinet\Entity;

use Money\Currency;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function setUp()
    {
        $this->defaultExpectedFirstname = 'dummy_firstname';
        $this->defaultExpectedLastname = 'dummy_lastname';
        $this->defaultExpectedDepositValue = 1000;
        $this->defaultExpectedCurrencyCode = new Currency('EUR');

        $this->defaultBankAcountAmount = 1000;

        $this->defaultBankClient = new BankClient(
            $this->defaultExpectedFirstname,
            $this->defaultExpectedLastname,
            new BankAccount($this->defaultBankAcountAmount, $this->defaultExpectedCurrencyCode)
        );
    }

    public function testCreateABankClientWithCorrectInformation()
    {
        $bankClient = clone $this->defaultBankClient;

        $this->assertEquals($this->defaultExpectedFirstname, $bankClient->getFirstname());
        $this->assertEquals($this->defaultExpectedLastname, $bankClient->getLastname());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateABankClientWithEmptyFirstname()
    {
        $bankClient = new BankClient(
            '',
            $this->defaultExpectedLastname,
            new BankAccount($this->defaultBankAcountAmount, $this->defaultExpectedCurrencyCode)
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateABankClientWithEmptyLastname()
    {
        $bankClient = new BankClient(
            $this->defaultExpectedFirstname,
            '',
            new BankAccount($this->defaultBankAcountAmount, $this->defaultExpectedCurrencyCode)
        );
    }

    public function testAsABankClientIMakeADepositInMyAccountWithCorrectInformation()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeDeposit($this->defaultExpectedDepositValue, $this->defaultExpectedCurrencyCode);

        $this->assertEquals(
            $this->defaultBankAcountAmount + $this->defaultExpectedDepositValue,
            $bankClient->getAccount()->getBalance()
        );
    }

    /**
     * @expectedException \Metinet\Exception\UnexpectedCurrencyCodeException
     */
    public function testAsABankClientIMakeADepositInMyAccountWithDifferentCurrencyCodeFromThatOfTheBankAccount()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeDeposit($this->defaultExpectedDepositValue, new Currency('USD'));
    }

    /**
     * @expectedException \Metinet\Exception\InvalidNegativeAmountException
     */
    public function testAsABankClientIMakeADepositInMyAccountWithNegativeAmount()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeDeposit(-100, $this->defaultExpectedCurrencyCode);
    }

    public function testAsABankClientIMakeAWithdrawalFromMyAccountWithCorrectInformation()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeWithdraw($this->defaultExpectedDepositValue, $this->defaultExpectedCurrencyCode);

        $this->assertEquals(
            $this->defaultBankAcountAmount - $this->defaultExpectedDepositValue,
            $bankClient->getAccount()->getBalance()
        );
    }

    /**
     * @expectedException \Metinet\Exception\UnexpectedCurrencyCodeException
     */
    public function testAsABankClientIMakeAWithdrawalFromMyAccountWithDifferentCurrencyCodeFromThatOfTheBankAccount()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeWithdraw($this->defaultExpectedDepositValue, new Currency('USD'));
    }

    /**
     * @expectedException \Metinet\Exception\InvalidNegativeAmountException
     */
    public function testAsABankClientIMakeAWithdrawalFromMyAccountWithNegativeAmount()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeWithdraw(-100, $this->defaultExpectedCurrencyCode);
    }

    /**
     * @expectedException \Metinet\Exception\NotSufficientAccountBalanceException
     */
    public function testAsABankClientIMakeAWithdrawalFromMyAccountWithInsufficientBalance()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeWithdraw(20000, $this->defaultExpectedCurrencyCode);
    }

    public function testAsABankClientIRetrieveTheHistoryOfMyOperations()
    {
        $bankClient = clone $this->defaultBankClient;

        $bankClient->makeDeposit($depositAmount = 100, $this->defaultExpectedCurrencyCode);
        $bankClient->makeWithdraw($withdrawAmount = 100, $this->defaultExpectedCurrencyCode);

        $history = $bankClient->getAccount()->getHistory();

        $this->assertEquals(BankOperationHistory::OPERATION_DEPOSIT, $history[0]->getOperation());
        $this->assertTrue($history[0]->getDate() <= new \DateTimeImmutable('now'));
        $this->assertEquals($depositAmount, $history[0]->getAmount());
        $this->assertEquals($this->defaultBankAcountAmount, $history[0]->getBalance());

        $this->assertEquals(BankOperationHistory::OPERATION_WITHDRAW, $history[1]->getOperation());
        $this->assertTrue($history[1]->getDate() <= new \DateTimeImmutable('now'));
        $this->assertEquals($withdrawAmount, $history[1]->getAmount());
        $this->assertEquals($this->defaultBankAcountAmount + $depositAmount, $history[1]->getBalance());
    }
}
