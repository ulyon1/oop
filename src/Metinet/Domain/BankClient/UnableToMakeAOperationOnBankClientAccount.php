<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:42
 */

namespace Metinet\Domain\BankClient;


class UnableToMakeAOperationOnBankClientAccount extends \DomainException
{
    public static function cannotHaveNullStatement(): self
    {
        return new self("A operation can't have null statement");
    }


}