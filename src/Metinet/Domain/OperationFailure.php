<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 18/01/19
 * Time: 10:34
 */

namespace Metinet\Domain;


class OperationFailure extends \Exception
{
    public static function testClientCannotOperateZeroNegativeAmount(): self{
        return new self("You cannot do an operation with a negative or null amount of money !");
    }

    public static function testClientCannotOperateDifferentCurrency(): self{
        return new self("You cannot do an operation with such kind of currency !");
    }

    public static function testClientInvalidMoneyAmount(): self{
        return new self("You're requesting an invalid amount of money, or you don't have enough money on your account !");
    }
}