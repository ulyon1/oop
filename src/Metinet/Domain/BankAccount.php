<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 18/01/19
 * Time: 09:19
 */

namespace Metinet\Domain;


use Money\Money;

class BankAccount
{
    private $id;
    private $name;
    private $ownedBy;
    private $moneyAmount;
    private $operations;

    /**
     * BankAccount constructor.
     * @param $name
     * @param $ownedBy
     * @param $moneyAmount
     */
    public function __construct(string $name, Client $ownedBy, Money $moneyAmount)
    {
        $this->name = $name;
        $this->ownedBy = $ownedBy;
        $this->moneyAmount = $moneyAmount;
        $this->operations = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Client
     */
    public function getOwnedBy(): Client
    {
        return $this->ownedBy;
    }

    /**
     * @return Money
     */
    public function getMoneyAmount(): Money
    {
        return $this->moneyAmount;
    }

    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @param Operation $op
     * @throws OperationFailure
     */
    public function addOperation(Operation $op): void{
        array_push($this->operations, $op);
        if($op->getOperationType() === 'withdraw'){
            if($this->moneyAmount->greaterThanOrEqual($op->getMoneyAmount()) && !$op->getMoneyAmount()->isZero() && !$op->getMoneyAmount()->isNegative()) {
                if($this->moneyAmount->isSameCurrency($op->getMoneyAmount())){
                    $this->moneyAmount->subtract($op->getMoneyAmount());
                }else{
                    throw OperationFailure::testClientCannotOperateDifferentCurrency();
                }
            }else{
                throw OperationFailure::testClientInvalidMoneyAmount();
            }
        }else if($op->getOperationType() === 'deposit'){
            if(!$op->getMoneyAmount()->isZero() && !$op->getMoneyAmount()->isNegative()) {
                if($this->moneyAmount->isSameCurrency($op->getMoneyAmount())){
                    $this->moneyAmount->add($op->getMoneyAmount());
                }else{
                    throw OperationFailure::testClientCannotOperateDifferentCurrency();
                }
            }else{
                throw OperationFailure::testClientCannotOperateZeroNegativeAmount();
            }
        }
    }
}