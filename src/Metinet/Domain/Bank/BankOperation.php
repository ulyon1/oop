<?php
namespace Metinet\Domain\Bank;


use Money\Money;

class BankOperation
{
    private $operationType;
    private $client;
    private $amount;
    private $date;
    private $balance;

    public function __construct(string $operationType, BankClient $client, Money $amount, \DateTimeImmutable $date, Money $balance)
    {
        $this->operationType = $operationType;
        $this->client = $client;
        $this->amount = $amount;
        $this->date = $date;
        $this->balance = $balance;
    }

    public static function makeDeposit(BankClient $client, Money $amount): self
    {
        $client->getAccount()->deposit($amount);

        return new self("Deposit", $client, $amount, new \DateTimeImmutable(), $client->getAccount()->getBalance());
    }

    public static function makeWithdraw(BankClient $client, Money $amount): self
    {
        $client->getAccount()->withdraw($amount);

        return new self("Withdraw", $client, $amount, new \DateTimeImmutable(), $client->getAccount()->getBalance());
    }

    public function __toString(): string
    {
        return $this->operationType.' : '.$this->amount->getAmount()." | Balance : ".$this->balance->getAmount()." | Date : ".$this->date->format("d-m-Y");
    }
}