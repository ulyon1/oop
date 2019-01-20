<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 11:01
 */

namespace Metinet\Domain\Bank;


class UnableToMakeOperationOnBankAccount extends \DomainException
{

    public static function unableToWithdrawalMoneyBecauseOverDraftNotAuthorized():self
    {
        return new self('You cannot withdrawal this amount because overdraft is not authorized on you account');
    }

}