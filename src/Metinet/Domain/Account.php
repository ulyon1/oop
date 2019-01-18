<?php
namespace Metinet\Domain;

use Money\Money;
use Metinet\Domain\History;
use Metinet\Domain\ExceptionList;
use DateTime;

class Account
{
	private $balance;
	private $overdraftAllowed;
	private $historyTab = null;

	public function __construct(Money $overdraftAllowed){
		$this->overdraftAllowed = Money::EUR(0);
		$this->checkCurrency($overdraftAllowed, $this->overdraftAllowed);
		$this->overdraftAllowed = $overdraftAllowed;
		$this->balance = Money::EUR(0);
	}

	public function depositMoney(Money $amount){
		try{
		$this->checkCurrency($amount, $this->balance);
		$this->balance->add($amount);
		$historyTab[] = new History("Deposit", new Datetime(), $amount, $this->balance);
		throw new ExceptionList("User Deposit Success");
		}
		catch(Exception $e){
			return $e->getMessage();
		}

	}

	public function withdrawalMoney(Money $amount){
		$this->checkCurrency($amount, $this->balance);
		if($this->balance->subtract($amount) < Money::EUR(0)->subtract($this->overdraftAllowed)){
			return new \Exception('Insuficient funds');
		}
		$this->balance->subtract($amount);
		$historyTab[] = new History("Withdrawal", new Datetime(), $amount, $this->balance);
		return new ExceptionList("User Withdrawal Success");
	}

	public function seeAllHistory(){
		if(is_null($this->historyTab)){
			return new \Exception('Empty history');
		}
		new \Exception('History succefully returned');
		return $this->historyTab;
	}

	private function checkCurrency(Money $currency1, Money $curency2){
		if(! $currency1->isSameCurrency($curency2)){
			return new \Exception('Bad Currency');
		}
		
	}

}