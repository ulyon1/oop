<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 18/01/19
 * Time: 09:11
 */

namespace Metinet\Domain;


use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    //public function testClientCanCheckHistory(): void {
        //TODO
    //}


    public function testClientCannotOperateZeroNegativeAmount(): void{
        $this->expectException(OperationFailure::class);
        $this->expectExceptionMessage("You cannot do an operation with a negative or null amount of money !");

        $client = new Client("Toto", "Dupont");
        $originAccount = new BankAccount("Livret A", $client, new Money('500', new Currency('EUR')));
        $bankAccount = new BankAccount("Livret A", $client, new Money('100', new Currency('EUR')));
        $op = new Operation("deposit", $client, $originAccount, $bankAccount, new Money('-55', new Currency('EUR')), new \DateTimeImmutable());
    }

    public function testClientCannotOperateDifferentCurrency(): void{
        $this->expectException(OperationFailure::class);
        $this->expectExceptionMessage("You cannot do an operation with such kind of currency !");

        $client = new Client("Toto", "Dupont");
        $originAccount = new BankAccount("Livret A", $client, new Money('500', new Currency('EUR')));
        $bankAccount = new BankAccount("Livret A", $client, new Money('100', new Currency('EUR')));
        $op = new Operation("deposit", $client, $originAccount, $bankAccount, new Money('50', new Currency('USD')), new \DateTimeImmutable());
    }

    public function testClientInvalidMoneyAmount(): void{
        $this->expectException(OperationFailure::class);
        $this->expectExceptionMessage("You're requesting an invalid amount of money, or you don't have enough money on your account !");

        $client = new Client("Toto", "Dupont");
        $originAccount = new BankAccount("Livret A", $client, new Money('500', new Currency('EUR')));
        $bankAccount = new BankAccount("Livret A", $client, new Money('10', new Currency('EUR')));
        $op = new Operation("withdraw", $client, $originAccount, $bankAccount, new Money('150', new Currency('EUR')), new \DateTimeImmutable());
        //ON SUPPOSE ICI QU'AUCUN DECOUVERT EST AUTORISE
    }
}