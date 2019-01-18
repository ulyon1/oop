<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:24
 */

namespace Metinet\Domain\Bank;


use Money\Money;

class BankAccount
{

    private $bankClient;
    /**
     * @var BankOperation[]
     */
    private $operations;

    public static function createAccount(BankClient $bankClient):self {
        return new self($bankClient);
    }

    public function getBalance():Money{
        $balance = Money::EUR(0);
        foreach ($this->operations as $operation){
            if ($operation instanceof Deposit){
                $balance = $balance->add($operation->getMoney());
            }
            elseif ($operation instanceof Withdrawal){
                $balance = $balance->subtract($operation->getMoney());
            }
        }

        return $balance;
    }

    public function makeDeposit(BankOperation $deposit):void {
        $this->operations[] = $deposit;
    }

    public function makeWithdrawal(BankOperation $withdrawal):void {
        $this->operations[] = $withdrawal;
    }

    public function getBankClient(): BankClient
    {
        return $this->bankClient;
    }

    public function getListOperations(): array
    {
        return $this->operations;
    }

    public function getLastOperation():BankOperation
    {
        $indexLastElement = count($this->operations) - 1;
        return $this->operations[$indexLastElement];
    }

    public function getLastDeposit():?BankOperation
    {
        for ($i = count($this->operations) - 1; $i >= 0; $i-- ){
            if ($this->operations[$i] instanceof Deposit){
                return $this->operations[$i];
            }
        }
        return null;
    }

    public function getLastWithdrawal():?BankOperation
    {
        dump($this->operations);
        for ($i = count($this->operations) - 1; $i >= 0; $i-- ){
            if ($this->operations[$i] instanceof Withdrawal){
                return $this->operations[$i];
            }
        }
        return null;
    }

    private function __construct(BankClient $bankClient)
    {
        $this->bankClient = $bankClient;
    }


}