<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:27
 */

namespace Metinet\Domain\Bank;


use Money\Money;

class Deposit{

    private $money;
    private $dateDeposit;

    public static function createDeposit(Money $money):self {
        return new self($money);
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getDateDeposit():\DateTimeImmutable
    {
        return $this->dateDeposit;
    }

    private function __construct(Money $money)
    {
        $this->dateDeposit = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $this->money = $money;
    }


}