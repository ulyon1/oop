<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:24
 */

namespace Metinet\Domain\Bank;


class BankAccount
{

    private $bankClient;
    /**
     * @var Deposit[]
     */
    private $listDeposit;

    public static function createAccount(BankClient $bankClient):self {
        return new self($bankClient);
    }

    public function makeDeposit(Deposit $deposit):void {
        $this->listDeposit[] = $deposit;
    }

    public function getBankClient(): BankClient
    {
        return $this->bankClient;
    }

    public function getListDeposit(): array
    {
        return $this->listDeposit;
    }

    public function getLastDeposit():Deposit
    {
        $indexLastElement = count($this->listDeposit) - 1;
        return $this->getListDeposit()[$indexLastElement];
    }

    private function __construct(BankClient $bankClient)
    {
        $this->bankClient = $bankClient;
    }


}