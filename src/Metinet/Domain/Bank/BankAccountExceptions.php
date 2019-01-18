<?php

namespace Metinet\Domain\Bank;


class BankAccountExceptions extends \DomainException
{
    public static function cantMakeADepositWithDifferentCurrencies(): self
    {
        return new self("Can't make a deposit with different currencies");
    }

    public static function cantMakeADepositOfANegativeAmountOfMoney(): self
    {
        return new self("Can't make a deposit of a negative amount of money");
    }

    public static function cantWithdrawANegativeAmountOfMoney(): self
    {
        return new self("Can't withdraw a negative amount of money");
    }

    public static function cantWithdrawOnAnAccountWithANegativeAmountOfMoney(): self
    {
        return new self("Can't withdraw on an account with a negative amount of money");
    }
}