<?php

namespace Metinet\Domain;

class ExceptionList extends \Exception{

	public static function userDepositIsSucess(): self{
		return new self("User Deposit Success");
	}
	public static function userHistoryReturned(): self{
		return new self("History succefully returned");
	}
	public static function userWithDrawAlIsSucess(): self{
		return new self("User Withdrawal Success");
	}

}
