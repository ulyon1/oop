<?php
/**
 * User: Hugo DEVELLY
 * Date: 18/01/2019
 * Time: 09:44
 */

namespace Metinet\Domain\BankClients;


use Money\Currency;
use Money\Money;

class BankAccount
{
    private $iban;
    private $balance;
    private $currency;
    private $maxOverdraft;

    public static function createBankAccount(string $iban, string $currency): BankAccount
    {
        $defaultCurrency = new Currency($currency);
        return new self($iban, $defaultCurrency, new Money(0, $defaultCurrency));
    }


    public function getBalance(): Money
    {
        return $this->balance;
    }

    public static function createBankAccountWithInitialDeposit(string $iban, string $currency, $initialDeposit): BankAccount
    {
        $defaultCurrency = new Currency($currency);
        return new self($iban, $defaultCurrency, new Money($initialDeposit, $defaultCurrency));
    }

    public function deposit(Money $sum): void
    {
        $this->ensureDepositIsValid($sum);
        $this->balance = $this->balance->add($sum);
    }

    public function withdraw(?Money $amount = null): Money
    {
        if($amount){
            $this->ensureAmountIsValid($amount);
            $this->ensureOverdraftLimitIsOk($amount);
        } else {
            $this->ensureBalanceIsPositive();
            $amount = $this->balance;
        }

        $this->balance = $this->balance->subtract($amount);
        return $amount;
    }


    private function __construct(string $iban, Currency $currency, Money $balance)
    {
        $this->iban = $iban;
        $this->balance = $balance;
        $this->currency = $currency;
        $this->maxOverdraft = new Money(-200, $currency);
    }


    private function ensureDepositIsValid(Money $sum): void
    {
        if ($sum->isNegative()) {
            throw DepositOperationsException::negativeDeposit();
        }
        if ($sum->isZero()) {
            throw DepositOperationsException::nullDeposit();
        }
        if (!$sum->isSameCurrency($this->balance)) {
            throw DepositOperationsException::differentCurrencyDeposit();
        }
    }


    private function ensureAmountIsValid(Money $amount): void
    {
        if ($amount->isNegative() || $amount->isZero()) {
            throw  BalanceOperationsException::invalidAmount();
        }
        if (!$amount->isSameCurrency($this->balance)) {
            throw BalanceOperationsException::differentCurrencyAmount();
        }
    }


    private function ensureOverdraftLimitIsOk(Money $amount): void
    {
        if ($this->balance->subtract($amount) < $this->maxOverdraft) {
            throw BalanceOperationsException::maxOverdraftExceeded();
        }
    }

    private function ensureBalanceIsPositive(): void
    {
        if ($this->balance->isNegative()) {
            throw BalanceOperationsException::negativeBalance();
        }
    }
}