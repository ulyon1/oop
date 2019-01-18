<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:50
 */

namespace Metinet\Domain\Bank;


use Metinet\Domain\Date;
use Money\Money;

class BankOperation
{
    private $type;
    private $amount;
    private $date;
    private $balanceAfter;

    public const ALLOWED_OPERATIONS = ['deposit', 'withdrawal', 'checkOperation'];

    public function __construct(string $type, Money $amount, Date $date, Money $newBalance)
    {
        if(!$this->checkIfOperationIsAllowed($type))
        {
            throw new OperationNotAllowed();
        }
        $this->type = $type;
        $this->amount = $amount;
        $this->date = $date;
        $this->balanceAfter = $newBalance;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function getBalanceAfter(): Money
    {
        return $this->balanceAfter;
    }

    public function checkIfOperationIsAllowed(string $operation): bool
    {
        return in_array($operation,self::ALLOWED_OPERATIONS);
    }

}