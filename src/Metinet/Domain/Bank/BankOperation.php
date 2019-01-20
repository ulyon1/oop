<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain\Bank;


use Money\Money;

interface BankOperation
{
    public static function create(Money $money):self;
    public function getMoney():Money;
    public function getDate():\DateTimeImmutable;

}