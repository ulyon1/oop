<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:27
 */

namespace Metinet\Domain\Bank;


use Metinet\Domain\Bank\History\History;
use Metinet\Domain\Bank\Operation\Deposit;
use Metinet\Domain\Bank\Operation\WithDrawal;
use Money\Currency;
use Money\Money;

class Account
{
    private $currentMoney;
    private $operationHistory;

    public function __construct()
    {
        $this->currentMoney = new Money(0, new Currency('EUR'));
        $this->operationHistory = new History();
    }

    public function getCurrentMoney(): Money
    {
        return $this->currentMoney;
    }

    public function getOperationHistory(): History
    {
        return $this->operationHistory;
    }

    public function deposit(int $amount)
    {
        $newAmount = (int)$this->currentMoney->getAmount() + $amount;

        $this->currentMoney = new Money($newAmount, new Currency('EUR'));
        $this->operationHistory->addOperation(new Deposit($amount), $this->currentMoney);
    }

    public function withDrawal(int $amount)
    {
        $newAmount = (int)($this->currentMoney->getAmount()) + $amount;

        $this->currentMoney = new Money($newAmount, new Currency('EUR'));
        $this->operationHistory->addOperation(new WithDrawal($amount), $this->currentMoney);
    }
}