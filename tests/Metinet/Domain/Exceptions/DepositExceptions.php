<?php

namespace Metinet\Domain\Bank;
use Money\Money;

class DepositExceptions{

    public function makeNegativeDeposit(Money $depositValue)
    {
        if($depositValue <= 0)
        {
            return false; 
        }
        else
        {
            return new Exception('Negative value');
        }
    }

    
}