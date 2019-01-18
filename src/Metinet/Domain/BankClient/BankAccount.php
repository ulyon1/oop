<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:23
 */

namespace Metinet\Domain\BankClient;


use Money\Money;

class BankAccount
{
    private $balance;
    private $operationHistory = [];

    /**
     * BankAccount constructor.
     * @param $balance
     * @param array $operationHistory
     */
    public function __construct(Money $balance)
    {

        $this->balance = $balance;
    }

    public function doAnOperation(string $operation, Money $amount, Money $balance)
    {

        $this->operationHistory [] = new BankOperation($operation,
            \DateTimeImmutable::createFromFormat('U', time(), new \DateTimeZone('UTC')),
            $amount,
            $balance);
    }

    public function retrieve($amount): Money
    {

        $this->balance = $this->balance->subtract($amount);
        return $this->balance;
    }

    public function deposit($amount): Money
    {

        $this->balance = $this->balance->add($amount);
        return $this->balance;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {

        return $this->balance;
    }

    /**
     * @return array
     */
    public function getOperationHistory(): array
    {

        return $this->operationHistory;
    }


}