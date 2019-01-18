<?php

namespace Metinet\Domain\Bank;

use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    public function testABankMustHaveName(): void
    {
        $bankName = "Crédit Agricole";
        $bank = new Bank($bankName);

        $this->assertEquals($bankName, $bank->getName());
    }

    public function testABankCannotHaveEmptyName(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The bank\'s name can not be empty');

        $emptyBankName = "";
        $bank = new Bank($emptyBankName);
    }

    public function testABankClientCannotHaveEmptyName(): void
    {
        //Ici je test que le client possède un nom et un prenom non vide
    }

    public function testABankCanAddBankClient(): void
    {
        $bank = new Bank('Crédit agricole');
        $newBankClient = new BankClient("Mael", "Brevet");

        $bankClient = $bank->addBankClient($newBankClient);

        $this->assertEquals($newBankClient->getFirstName(), $bankClient->getFirstName());
        $this->assertEquals($newBankClient->getLastName(), $bankClient->getLastName());
    }

    public function testAClientCanOpenAccount(): void
    {
        $bankClient = new BankClient("Mael", "Brevet");
        $currency = 'Eur';
        $bankClient->openAccount($currency);

        $this->assertEquals($currency, $bankClient->getAccount()->getCurrency());
    }

    public function testAClientCanDoADepositInHisAccount(): void
    {
        $bankClient = new BankClient("Mael", "Brevet");
        $bankClient->openAccount("Eur");

        //En centimes
        $depositAmount = 1340 * 100;

        $bankClient->makeDeposit($depositAmount);

        $this->assertEquals($depositAmount, $bankClient->getAccount()->getAmount());
    }
}
