<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:16
 */

namespace Metinet\Domain\Bank\BankClient;


use Metinet\Domain\Bank\BankAccount\BankAccount;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testABankClientCanBeCreate(): void
    {
        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(0), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);

        $this->assertEquals($firstName, $bankClient->getFirstName());
        $this->assertEquals($lastName, $bankClient->getLastName());
        $this->assertEquals($email, $bankClient->getEmail());
        $this->assertEquals($password, $bankClient->getPassword());
        $this->assertEquals($bankAccount, $bankClient->getBankAccount());
    }

    /*public function testABankClientDepositIsCorrect(): void
    {
        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(50), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);
        $bankClient->getBankAccount()->makeADeposit(Money::EUR(20));

        $this->assertEquals(Money::EUR(70), $bankClient->getBankAccount()->getBalance());
    }

    public function testABankClientWithdrawalIsCorrect(): void
    {
        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(100), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);
        $bankClient->getBankAccount()->makeAWithdrawal(Money::EUR(55));

        $this->assertEquals(Money::EUR(45), $bankClient->getBankAccount()->getBalance());
    }*/

    public function testABankClientCantMakeADepositWithAnotherCurrency(): void
    {
        $this->expectException(UnableToMakeADeposit::class);
        $this->expectExceptionMessage('Bank client cannot make a deposit with another currency');

        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(50), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);

        $amount = Money::USD(55);
        $bankClient->getBankAccount()->makeADeposit($amount);

        $this->assertEquals($bankClient->getBankAccount()->getCurrency(), $amount->getCurrency());
    }

    public function testABankClientCantMakeAWithdrawalWithAnotherCurrency(): void
    {
        $this->expectException(UnableToMakeAWithdrawal::class);
        $this->expectExceptionMessage('Bank client cannot make a withdrawal with another currency');

        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(100), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);

        $amount = Money::USD(55);
        $bankClient->getBankAccount()->makeAWithdrawal($amount);

        $this->assertEquals($bankClient->getBankAccount()->getCurrency(), $amount->getCurrency());
    }

    public function testABankClientCantMakeADepositWithANegativeAmount(): void
    {
        $this->expectException(UnableToMakeADeposit::class);
        $this->expectExceptionMessage('Bank client cannot make a deposit with a negative amount');

        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(50), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);

        $amount = Money::EUR(-15);
        $bankClient->getBankAccount()->makeADeposit($amount);

        $this->assertEquals(0, $amount);
    }

    public function testABankClientCantMakeAWithdrawalWithANegativeAmount(): void
    {
        $this->expectException(UnableToMakeAWithdrawal::class);
        $this->expectExceptionMessage('Bank client cannot make a withdrawal with a negative amount');

        $firstName = "Richard";
        $lastName = "Dassaut";
        $email = "richarddassaut@gmail.com";
        $password = "motdepasse";
        $bankAccount = new BankAccount("123456789", Money::EUR(100), new Currency("EUR"));

        $bankClient = BankClient::create($firstName, $lastName, $email, $password, $bankAccount);

        $amount = Money::EUR(-15);
        $bankClient->getBankAccount()->makeAWithdrawal($amount);

        $this->assertLessThan(0, $amount);
    }

    /*public function testABankClientCanSeeTheHistoryOfHisOperations(): void
    {

    }*/
}