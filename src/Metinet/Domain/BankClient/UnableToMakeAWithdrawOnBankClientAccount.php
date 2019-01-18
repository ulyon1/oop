<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:57
 */

namespace Metinet\Domain\BankClient;


class UnableToMakeAWithdrawOnBankClientAccount extends \DomainException
{
    public static function cannotHaveNullAmount(): self
    {
        return new self("A deposit can't get a null amount of money");
    }

    public static function cannotBeNegative(): self
    {
        return new self("A deposit can't get a negative amount of money");
    }

    public static function cannotWithdrawIfAccountIsUnder500(): self
    {
        return new self("A deposit can't be done if account is under 500");
    }
}