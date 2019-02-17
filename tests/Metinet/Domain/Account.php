<?php

namespace Metinet\Domain;
use Money\Currency;
use Money\Money;

class Account
{
    private $accountBalance;
    private $accountAllowedOverdraft;
    private $accountOperations;

    public function __construct(Money $accountBalance, Money $accountAllowedOverdraft)
    {
        $this->accountBalance = $accountBalance;
        $this->accountAllowedOverdraft = $accountAllowedOverdraft;
        $this->accountOperations = [];
    }

    private function makeSureAccountHasNotReachedMinimumBalance(): void
    {
        $mimimum = 0 - $accountAllowedOverdraft;

        if($this->accountBalance->lessThan($minimum))
        {
            throw new MinimumValueReached($this->accountBalance);
        }
    }

    private function makeWithdrawal(Operation $operation) : void
    {
        $this->makeSureAccountHasNotReachedMinimumBalance();
        $this->makeSureValidWithdrawalValue($operation);
        $this->accountOperations[] = $operation;
    }

    private function makeDeposit(Operation $operation)
    {
        $this->makeSureValidDepositValue($operation);
        $this->accountOperations[] = $operation;
    }

    public function makeSureValidWithdrawalValue(Operation $operation) : void
    {
        if($operation->operationType != "withdrawal" || $operation->operationValue->lessThan(0))
        {
            throw new InvalidOperationValue($operation);
        }
    }

    public function makeSureValidDepositValue(Operation $operation) : void
    {
        if($operation->operationType != "deposit" || $operation->operationValue < 0)
        {
            throw new InvalidOperationValue($operation->operationValue);
        }
    }

    public function getAccountBalance() : Money
    {
        return $this->accountBalance;
    }

    public function getAccountAllowedOverdraft() : float
    {
        return $this->accountAllowedOverdraft;
    }

    public function getAccountOperations() : Operation
    {
        foreach($this->accountOperations as $operation)
        {
            return $operation;
        }
    }

    public function getAccountOperationsHistory() : string
    {
        foreach($this->accountOperations as $operation)
        {
            return $operation;
        }
    }
}
