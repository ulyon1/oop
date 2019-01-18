<?php
namespace Metinet\Domain\Bank;

class BankClientMakeDeposit extends \DomainException
{
    public static function EnsureBankClientDpositIsPositif(): self
    {
        return new self(sprintf('Your deposit may have to be positive.'));
    }
    public static function EnsureBankClientDepositCurrencyIsSameAsHisAccount(): self
    {
        return new self(sprintf('The currency of your deposit cannot be different of your currency account.'));
    }
}
