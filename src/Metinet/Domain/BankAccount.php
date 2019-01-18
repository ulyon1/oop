<?php

namespace Metinet\Domain;

use Money\Money;
use Metinet\Domain\Operation\Operation;

class BankAccount
{
	private $firstname;
	private $lastname;
	private $balance;
	private $operations = [];

	public function __construct(string $firstname, string $lastname, ?Money $balance = null, array $operations = [])
	{
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->balance = $balance === null ? Money::EUR(0) : $balance;
		$this->operations = $operations;
	}

	public function getFirstname(): string
	{
		return $this->firstname;
	}

	public function getLastname(): string
	{
		return $this->lastname;
	}

	public function getBalance(): Money
	{
		return $this->balance;
	}

	public function getOperations(): array
	{
		return $this->operations;
	}

	public function addOperation(Operation $operation): self
	{
		$this->balance = $operation->executeOnBalance($this->balance);
		array_push($this->operations, $operation);

		return $this;
	}

	public function getOperationsData(): array
	{
		$result = [];
		foreach ($this->operations as $operation)
		{
			array_push($result, [
				'type' => $operation->getOperationType(),
				'amount' => $operation->getOperationAmount(), 
				'time' => $operation->getOperationTime(),
				'balanceAfter' => $operation->getBalanceAfter()
			]);
		}

		return $result;
	}
}
