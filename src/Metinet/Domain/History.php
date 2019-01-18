<?php
namespace Metinet\Domain;

use Money\Money;
use DateTime;

class History
{
	private $operation;
	private $date;
	private $amount;
	private $balance;

	public function __construct(string $operation, DateTime $date, Money $amount, Money $balance){
		$this->operation = $operation;
		$this->date = $date;
		$this->amount = $amount;
		$this->balance = $balance;
	}
}