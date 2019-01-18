<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:16
 */

namespace Metinet\Domain;

use Money\Currency;
use Money\Money;

class Account
{
    private $number;
    private $savings;
    private $history;
    private $currency;
    private $overdraft;

    public function __construct(Money $savings, Currency $currency/*, Money $overdraft*/)
    {
        $this->number = uniqid();
        $this->savings = $savings;
        $this->currency = $currency;
        //$this->overdraft = $overdraft;
        $this->history = new OperationsHistory();
    }

    public function deposit(Money $amount)
    {
        if($amount->getCurrency()->getCode() === $this->currency->getCode())
        {
            $this->savings = $this->savings->add($amount);
            $this->history->add(new Operation('deposit',
                new \DateTimeImmutable(),
                $amount,
                $this->savings));
        } else {
            throw ErrorsCurrency::cannotMakeDepositWithDifferentCurrencyAccount();
        }

    }

    public function withdrawal(Money $amount)
    {
        if($amount->getCurrency()->getCode() === $this->currency->getCode())
        {
//            if(!($this->savings->subtract($amount) > -($this->overdraft)))
//            {
                $this->savings = $this->savings->subtract($amount);
                $this->history->add(new Operation('withdrawal',
                    new \DateTimeImmutable(),
                    $amount,
                    $this->savings));
//            } else {
//                throw ErrorsUncovered::cannotHaveThisUncovered();
//            }
        } else {
            throw ErrorsCurrency::cannotMakeWithdrawalWithDifferentCurrencyAccount();
        }
    }

    public function getHistory(): OperationsHistory
    {
        return $this->history;
    }

    public function getSavings(): Money
    {
        return $this->savings;
    }



}