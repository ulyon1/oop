<?php

namespace Metinet\Domain;


class ErrorsCurrency extends \DomainException
{
    public static function cannotMakeDepositWithDifferentCurrencyAccount(): self
    {
        return new self('Bank Client cannot make a deposit with a wrong currency !');
    }
    public static function cannotMakeWithdrawalWithDifferentCurrencyAccount(): self
    {
        return new self('Bank Client cannot make a withdrawal with a wrong currency !');
    }
}