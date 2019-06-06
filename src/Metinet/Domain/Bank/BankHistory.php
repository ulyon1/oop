<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:58
 */

namespace Metinet\Domain\Bank;


class BankHistory
{
    private $operation;
    private $date;
    private $amount;
    private $balance;


    public function __construct(string $operation,\DateTimeImmutable $date, int $amount, int $balance)
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