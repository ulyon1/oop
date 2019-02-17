<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:47
 */

namespace Metinet\Domain\BankClient;


class UnableToGetOperationListOnBankClientAccount extends \DomainException
{
    public static function cannotGetOperationList(): self
    {
        return new self("Can't get Operation List");
    }

}