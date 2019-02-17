<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:01
 */

namespace Metinet\Domain\BankClient;


class UnableToTakeALookOnBankClientHistory extends \DomainException
{
    public static function cannotHaveNullStatement(): self
{
    return new self("A deposit can't get a null amount of money");
}
}