<?php

namespace Metinet\Domain\Operation;

use Money\Money;

interface Operation
{
	public function executeOnBalance(Money $balance): Money;
}
