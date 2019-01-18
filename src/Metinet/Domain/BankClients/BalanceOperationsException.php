<?php
/**
 * User: Hugo DEVELLY
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain\BankClients;


class BalanceOperationsException extends \DomainException
{
    public static function maxOverdraftExceeded(): self
    {
        return new self(sprintf('Authorized overdraft reached.'));
    }

    public static function negativeBalance(): self
    {
        return new self(sprintf('Current savings below 0.'));
    }
    public static function invalidAmount(): self
    {
        return new self(sprintf('Requested amount must be over 0.'));
    }
    public static function differentCurrencyAmount(): self
    {
        return new self(sprintf("Requested mount must be of the same currency as the account's balance."));
    }

}