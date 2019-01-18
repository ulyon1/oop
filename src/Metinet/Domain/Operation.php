<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 18/01/19
 * Time: 09:22
 */

namespace Metinet\Domain;


use Money\Money;

class Operation
{
    private $id;
    private $operationType;
    private $doneBy;
    private $originAccount;
    private $destinationAccount;
    private $moneyAmount;
    private $transactionDate;

    /**
     * Operation constructor.
     * @param string $operationType
     * @param Client $doneBy
     * @param BankAccount $originAccount
     * @param BankAccount $destinationAccount
     * @param Money $moneyAmount
     * @throws OperationFailure
     */
    public function __construct(string $operationType, Client $doneBy, BankAccount $originAccount, BankAccount $destinationAccount, Money $moneyAmount)
    {
        $this->operationType = $operationType;
        $this->doneBy = $doneBy;
        $this->originAccount = $originAccount;
        $this->destinationAccount = $destinationAccount;
        $this->moneyAmount = $moneyAmount;
        $this->transactionDate = new \DateTimeImmutable();

        $this->destinationAccount->addOperation($this);
        $this->originAccount->addOperation($this);
    }

    public function newOperation(string $operationType, Client $doneBy, BankAccount $originAccount, BankAccount $destinationAccount, Money $moneyAmount, \DateTimeImmutable $transactionDate){
        //N'est pas utilisé
        $op = new self($operationType, $doneBy, $originAccount, $destinationAccount, $moneyAmount,  $transactionDate);
        $op->getDestinationAccount()->addOperation($op);
        $op->getOriginAccount()->addOperation($op);
        return $op;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOperationType(): string
    {
        return $this->operationType;
    }

    /**
     * @return Client
     */
    public function getDoneBy(): Client
    {
        return $this->doneBy;
    }

    /**
     * @return BankAccount
     */
    public function getOriginAccount(): BankAccount
    {
        return $this->originAccount;
    }

    /**
     * @return BankAccount
     */
    public function getDestinationAccount(): BankAccount
    {
        return $this->destinationAccount;
    }

    /**
     * @return Money
     */
    public function getMoneyAmount(): Money
    {
        return $this->moneyAmount;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTransactionDate(): \DateTimeImmutable
    {
        return $this->transactionDate;
    }


}