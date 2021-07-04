<?php

namespace Metinet\Entity;

class BankOperationHistory
{
    const OPERATION_DEPOSIT = 'deposit';
    const OPERATION_WITHDRAW = 'withdraw';

    /**
     * @var string
     */
    private $operation;

    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var int
     */
    private $balance;

    public function __construct(string $operation, \DateTimeImmutable $date, int $amount, int $balance)
    {
        $this->operation = $operation;
        $this->date = $date;
        $this->amount = $amount;
        $this->balance = $balance;
    }

    public function getOperation(): string
    {
        return $this->operation;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }
}
