<?php
namespace Metinet\Domain\Bank;

/**
 *
 */
class Account
{

    private $sum;
    private $currency;

    function __construct($currency)
    {
        $this -> currency = $currency;
        $this -> sum = 0;
    }

    function getSum():int{
        return $this->sum;
    }
    function getCurrency(){
        return $this -> currency;
    }

    function deposit($amount, $currency):void{
        $this -> depositIsPositif($amount);
        $this -> sum += $amount;

    }
    function withdrawal($amount, $currency):void{

        $this -> sum -= $amount;

    }

    public function depositIsPositif($amount){
        if($amount < 1){
            throw BankClientMakeDeposit::EnsureBankClientDpositIsPositif();
        }
    }



}
