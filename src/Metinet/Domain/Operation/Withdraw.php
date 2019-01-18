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
		return $balance->subtract($this->withdrawAmount);
	}
}
