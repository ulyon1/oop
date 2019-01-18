<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 09:30
 */

namespace Metinet\Domain;


use Money\Currency;
use Money\Money;

class Account
{
    private $accountNumber;
    private $client;
    private $balance;
    private $accountCurrency;


    private function __construct(int $id, BankClient $client, Currency $currency )
    {
        $this->accountNumber=$id;
        $this->client=$client;
        $this->accountCurrency = $currency;
        $this->balance= new Money(0,$this->accountCurrency);
    }

    public static function openAccount(BankClient $client, string $currency):self
    {

        return new Account(random_int(100000,999999),$client, new Currency($currency));
    }

    /**
     * @return int
     *
     */
    public function getAccountNumber(): int
    {
        return $this->accountNumber;
    }

    /**
     * @return BankClient
     */
    public function getClient(): BankClient
    {
        return $this->client;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function ensureSameCurrency(Currency $currency):void
    {
        if(!$this->accountCurrency->equals($currency)){
            throw CurrencyError::DifferentCurrency();
        }
    }

    /**
     * @return Currency
     */
    public function getAccountCurrency(): Currency
    {
        return $this->accountCurrency;
    }

    public function withdraw(Money $withdrawal):void
    {
        $this->ensureSameCurrency($withdrawal->getCurrency());
        if($this->balance->subtract($withdrawal)->getAmount() <= 0 ) {
            throw NullOrNegativeBalanceAccount::nullOrNegativeBalanceAccount();
        }
        if($withdrawal->getAmount() <= 0){
            throw NullOrNegativeAmountAction::NullOrNegativeWithdrawal();
        }
        $this->balance= $this->balance->subtract($withdrawal);
    }

    public function deposit(Money $deposit):void
    {
        $this->ensureSameCurrency($deposit->getCurrency());
        if($deposit->getAmount()<=0){
            throw NullOrNegativeAmountAction::NullOrNegativeDeposit();
        }
        $this->balance = $this->balance->add($deposit);
    }


}