<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 09:10
 */

namespace Metinet;


use Metinet\Domain\Account;
use Metinet\Domain\BankClient;
use Metinet\Domain\CurrencyError;
use Metinet\Domain\History;
use Metinet\Domain\NullOrNegativeAmountAction;
use Metinet\Domain\NullOrNegativeBalanceAccount;
use Money\Money;
use PHPUnit\Framework\TestCase;

class BankClientAccountTest extends TestCase
{

    public function testABankClientCanMakeADeposit() :void
    {
        $client = BankClient::register("firstName","lastName",History::startRegisteringOperations());
        $account= Account::openAccount($client,"EUR");
        $deposit = Money::EUR(10);

        $expected = $account->getBalance()->add($deposit)->getAmount();
        $account->deposit($deposit);

        $this->assertEquals($client,$account->getClient());
        $this->expectException(CurrencyError::class);
        $this->expectExceptionMessage('Different currency');
        $this->assertEquals($account->getAccountCurrency(),$deposit->getCurrency());
        $this->expectException(NullOrNegativeAmountAction::class);
        $this->expectExceptionMessage('You cannot deposit a negative or a null amount. ');
        $this->assertLessThanOrEqual($deposit,0);

        $this->assertEquals($expected,$account->getBalance()->getAmount());


    }

    public function testABankClientCanWithdraw():void
    {
        $client = BankClient::register("firstName","lastName",History::startRegisteringOperations());
        $account= Account::openAccount($client, 'EUR');
        $withdrawal = Money::EUR(-15);


        $this->expectException(CurrencyError::class);
        $this->expectExceptionMessage('Different currency');
        $this->assertEquals($account->getAccountCurrency(),$withdrawal->getCurrency());

        $this->expectException(NullOrNegativeBalanceAccount::class);
        $this->expectExceptionMessage('Beware: this action will result in a negative balance account. ');
        $this->expectException(NullOrNegativeAmountAction::class);
        $this->expectExceptionMessage('You cannot withdraw a negative or a null amount.');
        $account->withdraw($withdrawal);
        $this->assertLessThanOrEqual(0,$account->getBalance()->getAmount());

    }

    public function testABankClientCanSeeTheirAccountHistory():void
    {
        $history= History::startRegisteringOperations();
        $client = BankClient::register("firstName","lastName", $history);

        $account= Account::openAccount($client, "EUR");
        $deposit = Money::EUR(10);
        $withdrawal = Money::EUR(15);

        $history=$client->getHistory();

        $history->addADepositAction($deposit,$account,new \DateTimeImmutable());
        $history->addAWithdrawalAction($withdrawal,$account,new \DateTimeImmutable());
        $this->assertEquals($client->getHistory(),$history);
        $history->getOperations();
    }

}