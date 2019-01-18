<?php

namespace tests\Metinet\Domain\Bank;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Metinet\Domain\ExceptionList;
use Metinet\Domain\Account;

class AccountTest extends TestCase{
	public function testADepositCanBeDoneOnClientAccount(): void{

		$this->expectException(ExceptionList::class);
		$this->expectExceptionMessage('User Deposit Success');

		$account = new Account(Money::EUR(0));
		$account->depositMoney(Money::EUR(100));

	}
	public function testCanSeeTheHistoryOfAnOperation(): void{

		$this->expectException(ExceptionList::class);
		$this->expectExceptionMessage('History succefully returned');

		$account = new Account(Money::EUR(0));
		$account->depositMoney(Money::EUR(100));
		$account->seeAllHistory();


	}
	public function testCanWithdrawalmoneyFromClientAccount(): void{
		$this->expectException(ExceptionList::class);
		$this->expectExceptionMessage('User Deposit Success');

		$account = new Account(Money::EUR(0));
		$account->depositMoney(Money::EUR(100));
		$account->withdrawalMoney(Money::EUR(50));
	}
}
