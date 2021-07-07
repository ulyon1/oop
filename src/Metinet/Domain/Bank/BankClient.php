<?php
namespace Metinet\Domain\Bank;

/**
 *
 */
class BankClient
{
    private $firstName;
    private $lastName;
    private $account;

    function __construct(string $firstName, string $lastName, Account $account)
    {
        $this -> firstName = $firstName;
        $this -> lastName = $lastName;
        $this -> account = $account;
    }

    public function getFirstName(): string{
        return $this -> firstName;
    }
    public function getLastName(): string{
        return $this -> lastName;
    }
    public function getAccount(): Account{
    return $this -> account;
    }


    public function makeDeposite(int $amount ,string $currency):void{
        $this -> testDepositCurrency($currency);
        $this -> account -> deposit($amount,$currency);

    }
    public function makeWithdrawal($amount,$currency){
        $this -> account -> withdrawal($amount,$currency);
    }

    public function testDepositCurrency($currency){
        if(! ($this -> account -> getCurrency() === $currency)){
            throw BankClientMakeDeposit::EnsureBankClientDepositCurrencyIsSameAsHisAccount();
        }
    }


}
