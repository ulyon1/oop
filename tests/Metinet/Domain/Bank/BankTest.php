<?php

namespace Metinet\Domain\Bank;

use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
  protected function setUp()
  {
    $this->client = new Client("Gérard", "Troipartrois");
  }

  public function testClientCanMakeDeposit()
  {
    $amount = 190;
    $this->client->makeDeposit($amount);

    $this->assertEquals($amount, $this->client->getAccount()->getBalance());
  }

  public function testClientCannotMakeNegativeDeposit()
  {
    $amount = -190;
    $expectedBalance = $this->client->getAccount()->getBalance();
    $this->expectException(OperationException::class);
    $this->expectExceptionMessage("Can't deposit a negative amount of money");
    $this->client->makeDeposit($amount);

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCannotMakeNullDeposit()
  {
    $amount = 0;
    $expectedBalance = $this->client->getAccount()->getBalance();
    $this->expectException(OperationException::class);
    $this->expectExceptionMessage("Can't deposit no amount of money");
    $this->client->makeDeposit($amount);

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCanWithdraw()
  {
    $initialAmount = 190;
    $amount = 180;
    $expectedBalance = $initialAmount - $amount;
    $this->client->makeDeposit($initialAmount);
    $this->client->withdrawSavings($amount);

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCanWithdrawAllSavings()
  {
    $initialAmount = 190;
    $expectedBalance = 0;
    $this->client->makeDeposit($initialAmount);
    $this->client->withdrawAllSavings();

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCannotWithdrawMoreThanBalance()
  {
    $amount = 190;
    $expectedBalance = $this->client->getAccount()->getBalance();
    $this->expectException(OperationException::class);
    $this->expectExceptionMessage("No debt allowed");
    $this->client->withdrawSavings($amount);

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCannotWithdrawNullAmount()
  {
    $amount = 0;
    $expectedBalance = $this->client->getAccount()->getBalance();
    $this->expectException(OperationException::class);
    $this->expectExceptionMessage("Can't withdraw no amount of money");
    $this->client->withdrawSavings($amount);

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCannotWithdrawNegativeAmount()
  {
    $amount = -190;
    $expectedBalance = $this->client->getAccount()->getBalance();
    $this->expectException(OperationException::class);
    $this->expectExceptionMessage("Can't withdraw a negative amount of money");
    $this->client->withdrawSavings($amount);

    $this->assertEquals($expectedBalance, $this->client->getAccount()->getBalance());
  }

  public function testClientCanGetOperationHistory()
  {
    $amount = 190;
    $this->client->makeDeposit($amount);
    $history = $this->client->getAccount()->getHistory();
    $lastOperation = $history[count($history) - 1];

    $this->assertEquals($amount, $lastOperation->getAmount());
    $this->assertEquals("deposit", $lastOperation->getOperationType());
  }
}