<?php

namespace Metinet\Domain\Bank;

class OperationException extends \DomainException
{
  public static function cantMakeNullDeposit(): self
  {
    return new self("Can't deposit no amount of money");
  }

  public static function cantMakeNegativeDeposit(): self
  {
    return new self("Can't deposit a negative amount of money");
  }

  public static function cantMakeNullWithdraw(): self
  {
    return new self("Can't withdraw no amount of money");
  }

  public static function cantMakeNegativeWithdraw(): self
  {
    return new self("Can't withdraw a negative amount of money");
  }

  public static function cantWithdrawMoreThanBalance(): self
  {
    return new self("No debt allowed");
  }
}