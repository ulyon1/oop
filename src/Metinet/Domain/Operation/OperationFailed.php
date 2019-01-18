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
}
