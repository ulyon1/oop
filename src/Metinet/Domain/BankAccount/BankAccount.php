<?php

namespace Metinet\Domain\BankAccount;

use phpDocumentor\Reflection\Types\Boolean;

class BankAccount
{
    private $totalMoneyAmount;
    private $operationHistory = [
        "operationType" => [],
        "operationAmount" => [],
        "operationDescription" => [],
        "operationDate" => []
    ];

    private function __construct(string $totalMoneyAmount)
    {
        $this->totalMoneyAmount = $totalMoneyAmount;
    }

    public static function createAccount(string $totalMoneyAmount ): BankAccount
    {
        return new self($totalMoneyAmount);
    }

    public function makeDeposit(int $depositAmount, string $depositDescription): Boolean
    {
        array_push($this->operationHistory["operationType"], "Deposit");
        array_push($this->operationHistory["operationAmount"], $depositAmount);
        array_push($this->operationHistory["operationDescription"], $depositDescription);
        array_push($this->operationHistory["operationDate"], date("Y-m-d"));

        $this->totalMoneyAmount += $depositAmount;
    }

    public function getTotalMoneyAmount(): string
    {
        return $this->firstName;
    }

    public function seeHistoryOfOperations()
    {
        return $this->operationHistory;
    }



}
