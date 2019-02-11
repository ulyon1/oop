<?php

namespace Metinet\Domain\Bank;

class Account
{
  private $balance;

  public static function createAccount(): Account
  {
    return new self();
  }

  private function __construct()
  {
    $this->balance = 0;
    $this->history = [];
  }

  public function getBalance(): int
  {
    return $this->balance;
  }

  public function getHistory()
  {
    return $this->history;
  }

  public function deposit(int $amount)
  {
    $this->ensureDepositIsPossible($amount);
    $this->saveOperation(OperationType::DEPOSIT, $amount);
    $this->balance += $amount;
  }

  public function withdraw(?int $amount = null)
  {
    if(isset($amount)) {
      $this->ensureWithdrawalIsPossible($amount);
      $this->saveOperation(OperationType::WITHDRAW, $amount);
    } else {
      $amount = $this->balance;
      $this->saveOperation(OperationType::WITHDRAW, $amount);
    }
    $this->balance -= $amount;
  }

  private function saveOperation(int $type, int $amount)
  {
    $this->history[] = new Operation($type, $amount, $this->balance);
  }


  private function ensureDepositIsPossible(int $amount)
  {
    if($amount == 0) {
      throw OperationException::cantMakeNullDeposit();
    }
    if($amount < 0) {
      throw OperationException::cantMakeNegativeDeposit();
    }
  }

  private function ensureWithdrawalIsPossible(int $amount)
  {
    if($amount == 0) {
      throw OperationException::cantMakeNullWithdraw();
    }
    if($amount < 0) {
      throw OperationException::cantMakeNegativeWithdraw();
    }
    if($amount > $this->balance) {
      throw OperationException::cantWithdrawMoreThanBalance();
    }
  }
}
