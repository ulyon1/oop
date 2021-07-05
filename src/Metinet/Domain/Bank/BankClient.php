<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:24
 */

namespace Metinet\Domain\Bank;

use Metinet\Domain\Bank\Operation\Deposit;

class BankClient
{
    private $id;
    private $bankClientDetail;
    private $account;

    public function __construct(string $firstname, string $lastname)
    {
        $this->id = uniqid();
        $this->bankClientDetail = new BankClientDetails($firstname, $lastname);
        $this->account = new Account();
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function getBankClientDetail(): BankClientDetails
    {
        return $this->bankClientDetail;
    }
    public function getAccount(): Account
    {
        return $this->account;
    }

    public function makeDeposit(int $amount)
    {
        $this->account->deposit($amount);
    }

    public function withDrawal(int $amount)
    {
        $this->account->withDrawal($amount);
    }


}