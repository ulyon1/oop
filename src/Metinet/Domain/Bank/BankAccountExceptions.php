<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:32
 */

namespace Metinet\Domain\Bank;


class BankAccountExceptions extends \DomainException
{
    public static function cannotMakeDepositWithEmptyBalance(): self
    {
        return new self('A client cannot make a deposit without balance');
    }

    public static function cannotMakeDepositWithDifferentCurrencies(): self
    {
        return new self('A client cannot make a deposit with different currencies');
    }

    public static function cannotMakeWithdrawalWithNegativeBalance(): self
    {
        return new self('A client cannot make a withdrawal with negative balance');
    }

    public static function cannotMakeWithdrawalWithBiggerAmount(): self
    {
        return new self('A client cannot make a withdrawal with less amount than balance');
    }

    public static function cannotMakeWithdrawalWithNegativeAmount(): self
    {
        return new self('A client cannot make a deposit without amount');
    }
}