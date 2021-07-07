<?php
namespace Metinet\Domain\Bank;


use PHPUnit\Framework\TestCase;

/**
 *
 */
class BankClientTest extends TestCase

{
    public function testABankHaveAName(){
        //on test ici que la bank a bien un nom avant d'être crée
    }



    public function testABankCanAddABankClient(){

        // $bank = New Bank($name);
        // $newBankClient = new BankClient("Mickael","Danjoux", "123456");
        //
        // $bankClient =   $bank -> addClient($newBankClient);
        //
        // $this -> assertEquals($bankClient -> getFirstName(), $bankNewClient -> getFirstName());
        // $this -> assertEquals($bankClient -> getLastName(), $bankNewClient -> getLastName());

    }

    public function testABankClientCanCreateAnAccount(){
        // $newBankClient = new BankClient("Mickael","Danjoux", "123456");



    }
    public function testABankClientCanMakeADepositInHisAccount(){
        $this->expectException(BankClientMakeDeposit::class);
        $this->expectExceptionMessageRegExp('/Your deposit was completed with success./');

        $account = New Account("EUR");
        $bankClient = new BankClient("Mickael","Danjoux", $account);
        $amount = 100;
        $bankClient -> makeDeposite($amount,"Eur");


        $this -> assertEquals($account -> getSum() , $amount);

    }
    public function testABankClientDepositIsPositif(){
        $this->expectException(BankClientMakeDeposit::class);
        $this->expectExceptionMessageRegExp('/Your deposit may have to be positive./');

        $account = New Account("EUR");
        $bankClient = new BankClient("Mickael","Danjoux", $account);
        $amount = -200;
        $bankClient -> makeDeposite($amount,"Eur");


        $this -> assertEquals($account -> getSum() , $amount);
        $this -> assertGreaterThan($amount,0);


    }

    public function testBankClientDepositCurrencyIsSameAsHisAccount(){
        $this->expectException(BankClientMakeDeposit::class);
        $this->expectExceptionMessageRegExp('/The currency of your deposit cannot be different of your currency account./');

        $account = New Account("EUR");
        $bankClient = new BankClient("Mickael","Danjoux", $account);
        $amount = 100;
        $depositCurrency = "USD";
        $bankClient -> makeDeposite($amount, $depositCurrency);

        $this -> assertEquals($account -> getCurrency() , $depositCurrency);

    }

    public function testBankClientCanMakeAWithdrawal(){

        $account = New Account("EUR");
        $bankClient = new BankClient("Mickael","Danjoux", $account);

        $bankClient -> makeDeposite(100, 'EUR');
        $withdrawal = 100;
        $sum = $account -> getSum();

        $bankClient -> makeWithdrawal(20,'EUR');

        $this -> assertEquals($account -> getSum() , $sum - $withdrawal);


    }
}
