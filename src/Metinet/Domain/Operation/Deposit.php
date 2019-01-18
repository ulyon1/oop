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

	public function getBalanceAfter(): ?Money
	{
		return $this->balanceAfter;
	}

	public function executeOnBalance(Money $balance): Money
	{
		if($this->depositAmount->isNegative())
			throw OperationFailed::cannotDepositNegativeValue();

		if($this->depositAmount->isZero())
			throw OperationFailed::cannotDepositZeroValue();

		if(!$this->depositAmount->isSameCurrency($balance))
			throw OperationFailed::cannotDepositAmountExpressedInOtherCurrency();

		return $this->balanceAfter = $balance->add($this->depositAmount);
	}

	public function getOperationType(): string
	{
		return 'deposit';
	}

	public function getOperationAmount(): Money
	{
		return $this->depositAmount;
	}

	public function getOperationTime(): \DateTimeImmutable
	{
		return $this->depositTime;
	}
}
