<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:36
 */

namespace Metinet\Domain\Bank;


class UnableToCreateBankClient extends \DomainException
{

    public static function unableToCreateWithEmptyFirstName():self
    {
        return new self('Bank client cannot be created with empty first name');
    }

    public static function unableToCreateWithEmptyLastName():self
    {
        return new self('Bank client cannot be created with empty last name');
    }

}