<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:25
 */

namespace Metinet\Domain;


use Money\Money;

class Operation
{
    private $type;
    private $date;
    private $amount;
    private $balance;

    public function __construct(string $type, \DateTimeImmutable $date, Money $amount, Money $balance)
    {
        $this->type = $type;
        $this->date = $date;
        $this->amount = $amount;
        $this->balance = $balance;
    }


}