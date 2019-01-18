<?php

namespace Metinet\Domain\Operation;

class OperationFailed extends \Exception
{
	public static function cannotDepositNegativeValue(): self
	{
		return new self('You can\'t deposit a negative amount');
	}
}
