<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:38
 */

namespace Metinet\Domain\Bank\Operation;


use Money\Money;

class Operation
{
    private $type;
    private $date;
    private $amount;



    public function __construct(string $type, \DateTimeImmutable $date, Money $amount)
    {
        $this->type = $type;
        $this->date = $date;
        $this->amount = $amount;
    }


    public function getType(): string
    {
        return $this->type;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }



}