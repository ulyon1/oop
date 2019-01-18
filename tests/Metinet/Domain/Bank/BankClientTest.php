<?php

namespace Metinet\Domain\Bank;

use PHPUnit\Framework\TestCase;

class BankClientTest extends TestCase
{
    /* Ajout de la Bank (En plus, pas obligatoire) */
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

    public function testABankCanAddBankClient(): void
    {
        $bank = new Bank('Crédit agricole');
        $newBankClient = new BankClient("Mael", "Brevet");

        $bankClient = $bank->addBankClient($newBankClient);

        $this->assertEquals($newBankClient->getFirstName(), $bankClient->getFirstName());
        $this->assertEquals($newBankClient->getLastName(), $bankClient->getLastName());
    }
    /* Fin de la Bank (petit plus) */

    public function testABankClientCannotHaveEmptyName(): void
    {
        //Ici je test que le client possède un nom et un prenom non vide
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

        // * 100 pour en centimes
        $depositAmount = 1340 * 100;

        $bankClient->makeDeposit($depositAmount);

        $this->assertEquals($depositAmount, $bankClient->getAccount()->getAmount());
    }

    public function testAClientCanMakeAWithdrawal(): void
    {
        $bankClient = new BankClient("Mael", "Brevet");
        $bankClient->openAccount("Eur");
        $bankClient->makeDeposit(1340 * 100);

        $clientAccountAmountBeforeWithdraw = $bankClient->getAccount()->getAmount();

        // *100 pour en centimes
        $withdrawalAmount = 100 * 100;

        $bankClient->makeWithdrawal($withdrawalAmount);

        $this->assertEquals($withdrawalAmount, $clientAccountAmountBeforeWithdraw - $bankClient->getAccount()->getAmount());
    }

    public function testAWithdrawCannotBeOverClientAccountAuthorisation(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('You have not enough money in your account');


        $bankClient = new BankClient("Mael", "Brevet");
        // 200 * 100 pour en centimes
        $bankClient->openAccount("Eur", 200 * 100);

        $withdrawalAmount = 500 * 100;

        $bankClient->makeWithdrawal($withdrawalAmount);

    }
}
