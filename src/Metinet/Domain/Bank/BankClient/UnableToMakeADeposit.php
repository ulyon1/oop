<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:34
 */

namespace Metinet\Domain\Bank\BankClient;


class UnableToMakeADeposit extends \DomainException
{
    public static function cannotMakeADepositWithAnotherCurrency(): self
    {
        return new self('Bank client cannot make a deposit with another currency');
    }

    public static function cannotMakeADepositWithANegativeAmount(): self
    {
            return new self('Bank client cannot make a deposit with a negative amount');
    }
}