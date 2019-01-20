<?php
namespace Metinet\Domain;

use Metinet\Domain\Account;

class Client
{
	private $lastName;
	private $firstName
	private $mail;
	private $account;

	public function __construct(string $lastName ="undefined", string $firstName ="undefined", string $mail = "undefined", Account $account){
		$this->lastName = $lastName;
		$this->firstName = $firstName;
		$this->mail = $mail;
		$this->account = $account;
	}

	public getLastName(){
		return $this->lastName;
	}
	public getFirstName(){
		return $this->firstName;
	}
	public getmail(){
		return $this->mail;
	}
	public getAccount(){
		return $this->account;
	}
}