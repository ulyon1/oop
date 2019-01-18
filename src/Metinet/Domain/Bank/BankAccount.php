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
    private $authorizeOverDraft;
    /**
     * @var BankOperation[]
     */
    private $operations;

    public static function createAccount(BankClient $bankClient, bool $authorizeOverDraft):self {
        return new self($bankClient, $authorizeOverDraft);
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
        $this->ensureBankClientCanWithdrawalAmount($withdrawal->getMoney());
    }

    public function getBankClient(): BankClient
    {
        return $this->bankClient;
    }

    public function isAuthorizeOverDraft(): bool
    {
        return $this->authorizeOverDraft;
    }

    public function getOperations(): array
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
        for ($i = count($this->operations) - 1; $i >= 0; $i-- ){
            if ($this->operations[$i] instanceof Withdrawal){
                return $this->operations[$i];
            }
        }
        return null;
    }

    private function __construct(BankClient $bankClient, bool $authorizeOverDraft)
    {
        $this->bankClient = $bankClient;
        $this->authorizeOverDraft = $authorizeOverDraft;
    }

    private function ensureBankClientCanWithdrawalAmount(Money $money){
        if ($this->getBalance()->subtract($money)->getAmount() < 0){
            array_pop($this->operations);
            throw UnableToMakeOperationOnBankAccount::unableToWithdrawalMoneyBecauseOverDraftNotAuthorized();
        }
    }


}