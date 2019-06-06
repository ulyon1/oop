<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:14
 */

namespace Metinet\Domain\Bank;


use Money\Currency;

class BankAccount
{

    private $balance;
    private $currency;


    public function __construct(int $balance, Currency $currency)
    {

        $this->currency = $currency;
        $this->balance = $balance;
    }


    public function getBalance()
    {
        return $this->balance;
    }


    public function getCurrency(): string
    {
        return $this->currency;
    }



    protected function checkBalance($balance)
    {
        if ($balance >= 0) {
            $this->balance = $balance;
        } else {
            throw BankAccountExceptions::cannotMakeDepositWithEmptyBalance();
        }
    }

    protected function checkCurrencies($currencies)
    {
        if(!$this->currency->equals($currencies)){
            throw BankAccountExceptions::cannotMakeDepositWithDifferentCurrencies();
        }
    }

    public function makeADeposit($balance,$currencies)
    {
        $this->checkBalance($this->getBalance() + $balance);

        $this->checkCurrencies($currencies);

        return $this->getBalance();
    }

    public function withdrawMoney($balance,$amount,$currencies)
    {
        $this->checkBalance($this->getBalance() - $balance);

        $this->checkCurrencies($currencies);

        if($balance <= 0){
            throw BankAccountExceptions::cannotMakeWithdrawalWithNegativeBalance();
        }

        if($amount > $balance){
            throw BankAccountExceptions::cannotMakeWithdrawalWithBiggerAmount();
        }

        if($amount <= 0){
            throw BankAccountExceptions::cannotMakeWithdrawalWithNegativeAmount();
        }

        return $this->getBalance();
    }



}