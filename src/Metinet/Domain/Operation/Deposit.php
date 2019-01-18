<?php

namespace Metinet\Domain\Operation;

use Money\Money;

class Deposit implements Operation
{
	private $depositAmount;
	private $depositTime;
	private $balanceAfter;

	public function __construct(Money $depositAmount, ?\DateTimeImmutable $depositTime = null)
	{
		$this->depositAmount = $depositAmount;
		$this->depositTime = $depositTime === null ? new \DateTimeImmutable() : $depositTime;
	}

	public function getDepositAmount(): Money
	{
		return $this->depositAmount;
	}

	public function getDepositTime(): \DateTimeImmutable
	{
		return $this->depositTime;
	}

	public function executeOnBalance(Money $balance): Money
	{
		if($this->depositAmount->isNegative())
			throw OperationFailed::cannotDepositNegativeValue();

		return $balance->add($this->depositAmount);
	}
}
