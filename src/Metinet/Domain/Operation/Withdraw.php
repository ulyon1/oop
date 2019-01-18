<?php

namespace Metinet\Domain\Operation;

use Money\Money;

class Withdraw implements Operation
{
	private $withdrawAmount;
	private $withdrawTime;
	private $balanceAfter;

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

	public function getBalanceAfter(): ?Money
	{
		return $this->balanceAfter;
	}

	public function executeOnBalance(Money $balance): Money
	{
		if($this->withdrawAmount->isNegative())
			throw OperationFailed::cannotWithdrawNegativeValue();

		if($this->withdrawAmount->isZero())
			throw OperationFailed::cannotWithdrawZeroValue();

		if(!$this->withdrawAmount->isSameCurrency($balance))
			throw OperationFailed::cannotWithdrawAmountExpressedInOtherCurrency();

		if($balance->lessThan($this->withdrawAmount))
			throw OperationFailed::cannotWithdrawMoreThanAccountCredit();

		return $this->balanceAfter = $balance->subtract($this->withdrawAmount);
	}

	public function getOperationType(): string
	{
		return 'withdraw';
	}

	public function getOperationAmount(): Money
	{
		return $this->withdrawAmount;
	}

	public function getOperationTime(): \DateTimeImmutable
	{
		return $this->withdrawTime;
	}
}
