<?php

namespace Metinet\Domain\Bank;

class Operation
{
  private $date;
  private $operationType;
  private $amount;
  private $balance;

  public function __construct(int $operationType, int $amount, int $balance)
  {
    $this->date = \DateTimeImmutable::createFromFormat('U', time(), new \DateTimeZone('UTC'));
    $this->operationType = $operationType;
    $this->amount = $amount;
    $this->balance = $balance;
  }

  public function getAmount(): int
  {
    return $this->amount;
  }

  public function getBalance(): int
  {
    return $this->balance;
  }

  public function getDate(): int
  {
    return $this->date;
  }

  public function getOperationType(): string
  {
    switch ($this->operationType) {
      case OperationType::DEPOSIT:
        return "deposit";
        break;
      case OperationType::WITHDRAW:
        return "withdrawal";
        break;
    }
  }
  
  public function getNewBalance(): int
  {
    switch ($this->operationType) {
      case OperationType::DEPOSIT:
        return $this->balance + $this->amount;
        break;
      case OperationType::WITHDRAW:
        return $this->balance - $this->amount;
        break;
    }
  }
}