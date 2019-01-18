<?php

namespace Metinet\Entity;

use Metinet\Exception\InvalidNegativeAmountException;
use Metinet\Exception\NotSufficientAccountBalanceException;
use Metinet\Exception\UnexpectedCurrencyCodeException;
use Money\Currency;

class BankAccount
{
    /**
     * @var int
     */
    private $balance;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var array<BankOperationHistory>
     */
    private $history;

    public function __construct(int $balance, Currency $currency)
    {
        $this->balance = $balance;
        $this->currency = $currency;
        $this->history = [];
    }

    public function deposit(int $amount, Currency $currency)
    {
        if ($amount < 0) {
            throw new InvalidNegativeAmountException('The deposit value can\'t be negative');
        }

        if ($currency->getCode() !== $this->currency->getCode()) {
            throw new UnexpectedCurrencyCodeException('The currency code that you given is different from the account');
        }

        $this->history[] = new BankOperationHistory(
            BankOperationHistory::OPERATION_DEPOSIT,
            new \DateTimeImmutable('now'),
            $amount,
            $this->balance
        );

        $this->balance += $amount;
    }

    public function withdraw(int $amount, Currency $currency)
    {
        if ($amount < 0) {
            throw new InvalidNegativeAmountException('The withdrawal value can\'t be negative');
        }

        if ($currency->getCode() !== $this->currency->getCode()) {
            throw new UnexpectedCurrencyCodeException('The currency code that you given is different from the account');
        }

        if ($this->balance < $amount) {
            throw new NotSufficientAccountBalanceException($this->balance, $amount);
        }

        $this->history[] = new BankOperationHistory(
            BankOperationHistory::OPERATION_WITHDRAW,
            new \DateTimeImmutable('now'),
            $amount,
            $this->balance
        );

        $this->balance -= $amount;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getHistory(): array
    {
        return $this->history;
    }
}
