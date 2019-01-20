<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:27
 */

namespace Metinet\Domain\Bank;


use Money\Money;

class Deposit implements BankOperation {

    private $money;
    private $dateDeposit;

    public static function create(Money $money):BankOperation {
        return new self($money);
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getDate():\DateTimeImmutable
    {
        return $this->dateDeposit;
    }

    private function __construct(Money $money)
    {
        $this->dateDeposit = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $this->money = $money;
    }
}