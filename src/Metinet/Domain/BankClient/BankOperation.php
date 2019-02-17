<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:25
 */

namespace Metinet\Domain\BankClient;


use Money\Money;

class BankOperation
{
    private $operation;
    private $date;
    private $amount;
    private $balance;

    /**
     * BankOperation constructor.
     * @param $operation
     * @param $date
     * @param $amount
     * @param $balance
     */
    public function __construct(string $operation,\DateTimeImmutable $date,Money $amount,Money $balance)
    {

        $this->operation = $operation;
        $this->date = $date;
        $this->amount = $amount;
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {

        return $this->operation;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {

        return $this->date;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {

        return $this->amount;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {

        return $this->balance;
    }




}