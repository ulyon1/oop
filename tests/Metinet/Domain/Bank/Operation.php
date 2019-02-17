<?php

namespace Metinet\Domain\Bank;
use Money\Money;
use Metinet\Domain\Bank\Account;

class Operation{

    private $operationValue;
    private $account;
    private $date;
    private $operationType;

    
    

    public function __construct(Money $operationValue, Account $account, \DateTime $date, string $operationType)
    {
        $this->operationValue = Money::EUR($operationValue);
        $this->account = $account;
        $this->date = $date;
        $this->operationType = $operationType;
       
        if($operationType == 'withdrawal')
        {
            $account::makeWithdrawal($operationValue, $account);
        }
        elseif($operationType == 'deposit')
        {
            $account::makeDeposit($operationValue, $account);
        }
    }

   
    
}