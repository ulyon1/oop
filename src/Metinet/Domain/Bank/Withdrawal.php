<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:42
 */

namespace Metinet\Domain\Bank;


use Money\Money;

class Withdrawal implements BankOperation
{

    private $money;
    private $date;

    public static function create(Money $money):BankOperation {
        return new self($money);
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getDate():\DateTimeImmutable
    {
        return $this->date;
    }

    private function __construct(Money $money)
    {
        $this->date = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $this->money = $money;
    }


}