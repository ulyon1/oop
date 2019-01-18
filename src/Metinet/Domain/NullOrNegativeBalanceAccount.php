<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain;


class NullOrNegativeBalanceAccount extends \DomainException
{
    public static function nullOrNegativeBalanceAccount():self
    {
        return new self(
            sprintf("Beware: this action will result in a negative balance account. ")
        );
    }
}