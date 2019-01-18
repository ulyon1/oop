<?php
/**
 * User: Hugo DEVELLY
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain\BankClients;


class DepositOperationsException extends \DomainException
{
    public static function nullDeposit(): self
{
    return new self(sprintf('Deposit cannot amount to 0.'));
}

    public static function negativeDeposit(): self
{
    return new self(sprintf('Deposit cannot be below 0.'));
}
    public static function differentCurrencyDeposit(): self
{
    return new self(sprintf("Deposit must be of the same currency as the account's balance."));
}

}