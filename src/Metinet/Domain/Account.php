<?php

namespace Metinet\Domain;


class Account
{
    private $sumInEuros;

    public function __construct()
    {
        $this->sumInEuros = 0;
    }

    public function addDepositInEurosToSumInEuros(int $deposit): void
    {
        $this->sumInEuros += $deposit;
    }

    public function makeAWithdrawalInEuros(int $withdrawal): int
    {
        $this->sumInEuros -= $withdrawal;
        return $withdrawal;
    }

    public function getSumInEuros(): int
    {
        return$this->sumInEuros;
    }
}