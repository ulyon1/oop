<?php

namespace Metinet\Domain\Operation;

class OperationFailed extends \Exception
{
	public static function cannotDepositNegativeValue(): self
	{
		return new self('You can\'t deposit a negative amount');
	}

	public static function cannotDepositZeroValue(): self
	{
		return new self('The deposit amount must be greater than 0');
	}

	public static function cannotDepositAmountExpressedInOtherCurrency(): self
	{
		return new self('You cannot deposit an amount expressed in another currency');
	}

	public static function cannotWithdrawMoreThanAccountCredit(): self
	{
		return new self('Your account credit is too low to withdraw this amount');
	}

	public static function cannotWithdrawNegativeValue(): self
	{
		return new self('You can\'t withdraw a negative amount');
	}

	public static function cannotWithdrawZeroValue(): self
	{
		return new self('The withdraw amount must be greater than 0');
	}

	public static function cannotWithdrawAmountExpressedInOtherCurrency(): self
	{
		return new self('You cannot withdraw an amount expressed in another currency');
	}
}
