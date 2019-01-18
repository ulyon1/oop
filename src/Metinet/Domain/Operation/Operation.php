<?php

namespace Metinet\Domain\Operation;

use Money\Money;

interface Operation
{
	public function executeOnBalance(Money $balance): Money;

	public function getOperationType(): string;
	public function getOperationAmount(): Money;
	public function getOperationTime(): \DateTimeImmutable;
	public function getBalanceAfter(): ?Money;
}
