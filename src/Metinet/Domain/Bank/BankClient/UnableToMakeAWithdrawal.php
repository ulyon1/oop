<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:35
 */

namespace Metinet\Domain\Bank\BankClient;


class UnableToMakeAWithdrawal extends \DomainException
{
    public static function cannotMakeAWithdrawalWithAnotherCurrency(): self
    {
        return new self('Bank client cannot make a withdrawal with another currency');
    }

    public static function cannotMakeAWithdrawalWithANegativeAmount(): self
    {
        return new self('Bank client cannot make a withdrawal with a negative amount');
    }

}