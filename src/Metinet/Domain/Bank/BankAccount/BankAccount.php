<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:33
 */

namespace Metinet\Domain\Bank\BankAccount;


use Metinet\Domain\Bank\BankClient\UnableToMakeADeposit;
use Metinet\Domain\Bank\BankClient\UnableToMakeAWithdrawal;
use Metinet\Domain\Bank\Operation\Operation;
use Money\Currency;
use Money\Money;

class BankAccount
{
    private $number;
    private $balance;
    private $currency;
    private $operations;

    public function makeADeposit(Money $amount)
    {
        if ($amount->getAmount() < 0) {

            throw UnableToMakeADeposit::cannotMakeADepositWithANegativeAmount();
        }

        if ($amount->getCurrency() !== $this->currency) {

            throw UnableToMakeADeposit::cannotMakeADepositWithAnotherCurrency();
        }

        $this->balance = $this->balance->add($amount);
        $array[] = new Operation("Credit", new \DateTimeImmutable("now"), $amount);
        $this->operations = $array;
    }

    public function makeAWithdrawal(Money $amount)
    {
        if ($amount->getAmount() < 0) {

            throw UnableToMakeAWithdrawal::cannotMakeAWithdrawalWithANegativeAmount();
        }

        if ($amount->getCurrency() !== $this->currency) {

            throw UnableToMakeAWithdrawal::cannotMakeAWithdrawalWithAnotherCurrency();
        }

        $this->balance = $this->balance->subtract($amount);
        $array[] = new Operation("Debit", new \DateTimeImmutable("now"), $amount);
        $this->operations = $array;
    }

    public function __construct(string $number, Money $balance, Currency $currency)
    {
        $this->number = $number;
        $this->balance = $balance;
        $this->currency = $currency;
    }

    
    public function getNumber(): string
    {
        return $this->number;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }
    
    public function getOperations(): array
    {
        return $this->operations;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }


    
    


}