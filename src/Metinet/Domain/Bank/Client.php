<?php

namespace Metinet\Domain\Bank;

class Client
{
  private $firstName;
  private $lastName;
  private $account;

  public function __construct(string $fn, string $ln)
  {
    $this->firstName = $fn;
    $this->lastName = $ln;
    $this->account = Account::createAccount();
  }

  public function getFirstName(): string
  {
    return $this->firstName;
  }

  public function getLastName(): string
  {
    return $this->lastName;
  }

  public function getAccount(): Account
  {
    return $this->account;
  }

  public function makeDeposit(int $amount)
  {
    $this->account->deposit($amount);
  }

  public function withdrawSavings(int $amount)
  {
    $this->account->withdraw($amount);
  }

  public function withdrawAllSavings()
  {
    $this->account->withdraw();
  }
}
