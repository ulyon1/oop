<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:08
 */

namespace Metinet\Domain\BankClient;

use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testABankClientCanBeCreated()
    {

        $firstName = "Yoann";
        $lastName = "Dufour";
        $account = new BankAccount(Money::EUR(5000));

        $bankClient = new BankClient($firstName, $lastName, $account);

        $this->assertEquals($firstName, $bankClient->getFirstName());
        $this->assertEquals($lastName, $bankClient->getLastName());
        $this->assertEquals($account, $bankClient->getAccount());
    }

    public function testABankClientCannotDoANullDeposit()
    {
        $this->expectException(UnableToMakeADepositOnBankClientAccount::class);
        $this->expectExceptionMessage('A deposit can\'t get a null amount of money');
        $firstName = "Yoann";
        $lastName = "Dufour";
        $account = new BankAccount(Money::EUR(5000));

        $bankClient = new BankClient($firstName, $lastName, $account);
        $amount = Money::EUR(0);
        $bankClient->depositMoney($amount);

    }

    public function testABankClientCannotDoANegativeDeposit()
    {
        $this->expectException(UnableToMakeADepositOnBankClientAccount::class);
        $this->expectExceptionMessage('A deposit can\'t get a negative amount of money');
        $firstName = "Yoann";
        $lastName = "Dufour";
        $account = new BankAccount(Money::EUR(5000));

        $bankClient = new BankClient($firstName, $lastName, $account);
        $amount = Money::EUR(-500);
        $bankClient->depositMoney($amount);
    }

    public function testABankClientCannotDoANullWithdraw()
    {
        $this->expectException(UnableToMakeAWithdrawOnBankClientAccount::class);
        $this->expectExceptionMessage('A deposit can\'t get a null amount of money');
        $firstName = "Yoann";
        $lastName = "Dufour";
        $account = new BankAccount(Money::EUR(5000));

        $bankClient = new BankClient($firstName, $lastName, $account);
        $amount = Money::EUR(0);
        $bankClient->withdrawMoney($amount);
    }

    public function testABankClientCannotDoANegativeWithdraw()
    {
        $this->expectException(UnableToMakeAWithdrawOnBankClientAccount::class);
        $this->expectExceptionMessage('A deposit can\'t get a negative amount of money');
        $firstName = "Yoann";
        $lastName = "Dufour";
        $account = new BankAccount(Money::EUR(5000));

        $bankClient = new BankClient($firstName, $lastName, $account);
        $amount = Money::EUR(-500);
        $bankClient->withdrawMoney($amount);
    }

    // Non Fonctionnel
    /*
    public function testABankClientCannotWithdrawWhenAccountIsUnder500()
    {
        $this->expectException(UnableToMakeAWithdrawOnBankClientAccount::class);
        $this->expectExceptionMessage('A deposit can\'t be done if account is under 500');
        $firstName = "Yoann";
        $lastName = "Dufour";
        $account = new BankAccount(Money::EUR(500));

        $bankClient = new BankClient($firstName, $lastName, $account);
        $amount = Money::EUR(-1500);
        $bankClient->withdrawMoney($amount);
    }

        public function testABankClientCanTakeALookOnHisHistory()
        {
            $firstName = "Yoann";
            $lastName = "Dufour";
            $account = new BankAccount(Money::EUR(5000));

            $bankClient = new BankClient($firstName, $lastName, $account);
            $amount = Money::EUR(500);
            $bankClient->depositMoney($amount);
        }*/

}
