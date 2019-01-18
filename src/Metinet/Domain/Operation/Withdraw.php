<?php

namespace Metinet\Domain\Operation;

use Money\Money;

class Withdraw implements Operation
{
	private $withdrawAmount;
	private $withdrawTime;

	public function __construct(Money $withdrawAmount, ?\DateTimeImmutable $withdrawTime = null)
	{
		$this->withdrawAmount = $withdrawAmount;
		$this->withdrawTime = $withdrawTime === null ? new \DateTimeImmutable() : $withdrawTime;
	}

	public function getWithdrawAmount(): Money
	{
		return $this->withdrawAmount;
	}

	public function getWithdrawTime(): \DateTimeImmutable
	{
		return $this->withdrawTime;
	}

	public function executeOnBalance(Money $balance): Money
	{
		if($this->withdrawAmount->isNegative())
			throw OperationFailed::cannotWithdrawNegativeValue();

		if($this->withdrawAmount->isZero())
			throw OperationFailed::cannotWithdrawZeroValue();

		if($balance->lessThan($this->withdrawAmount))
			throw OperationFailed::cannotWithdrawMoreThanAccountCredit();

		return $balance->subtract($this->withdrawAmount);
	}
}
