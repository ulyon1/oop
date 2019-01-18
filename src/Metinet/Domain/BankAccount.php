<?php

namespace Metinet\Domain;

class BankAccount
{
	private $firstname;
	private $lastname;

	public function __construct(string $firstname, string $lastname)
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
	}

	public function getFirstname(): string
	{
		return $this->firstname;
	}

	public function getLastname(): string
	{
		return $this->lastname;
	}
}
