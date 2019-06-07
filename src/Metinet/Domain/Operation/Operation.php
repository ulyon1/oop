<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:43
 */

namespace Metinet\Domain\Operation;

use Money\Money;

class Operation
{
    private $date;
    private $amount;
    private $balance;

    public function __construct(Money $amount, Money $balance)
    {
        $this->date = new \DateTimeImmutable();
        $this->amount = $amount;
        $this->balance = $balance;
    }
}