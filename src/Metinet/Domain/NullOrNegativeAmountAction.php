<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 10:40
 */

namespace Metinet\Domain;


class NullOrNegativeAmountAction extends \DomainException
{
    public static function NullOrNegativeDeposit():self
    {
        return new self(sprintf(
            'You cannot deposit a negative or a null amount. '
        ));
    }

    public static function NullOrNegativeWithdrawal():self
    {
        return new self(sprintf(
            'You cannot withdraw a negative or a null amount. '
        ));
    }
}