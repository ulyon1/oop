

    <?php

namespace Metinet\Domain\Bank;
use Money\Money;

class WithdrawalExceptions{

    public function checkCurrency(Monney $currency1, Monney $currency2)
    {
        if($currency1->isSameCurrency($currency2))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

    public function checkBankAccountAmmount(Monney $accountBalance, Money $minimumAccountBalance, Money $withdrawalAmount)
    {
        $accountBalanceAfterWithdrawal = $accountBalance->subtract($withdrawalAmount);

        if($minimumAccountBalance->lessThan($accountBalanceAfterWithdrawal))
        {
            return true;
        }
        else
        {
            return Exception('Insufficent funds');
        }
        
    }
}

