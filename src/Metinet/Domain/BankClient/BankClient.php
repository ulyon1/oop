<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:20
 */

namespace Metinet\Domain\BankClient;


use Money\Money;

class BankClient
{
    private $firstName;
    private $lastName;
    private $account;

    /**
     * BankClient constructor.
     * @param $firstName
     * @param $lastname
     * @param $account
     */
    public function __construct(string $firstName, string $lastName, BankAccount $account)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->account = $account;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {

        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {

        return $this->lastName;
    }

    /**
     * @return BankAccount
     */
    public function getAccount(): BankAccount
    {

        return $this->account;
    }

    public function withdrawMoney(Money $amount)
    {

        $this->ensureValidWithdraw($amount);
        $balance = $this->account->retrieve($amount);
        $this->account->doAnOperation("Withdraw", $amount, $balance);
    }

    public function depositMoney(Money $amount)
    {

        $this->ensureValidDeposit($amount);
        $balance = $this->account->deposit($amount);
        $this->account->doAnOperation("Deposit", $amount, $balance);
    }

    /**
     * @return array
     */
    public function getAccountOperations()
    {

        return $this->account->getOperationHistory();
    }

    public function ensureValidWithdraw(Money $amount)
    {

        if ($amount->isZero() || $amount === null) {
            throw UnableToMakeAWithdrawOnBankClientAccount::cannotHaveNullAmount();
        }
        if ($amount->isNegative()) {
            throw UnableToMakeAWithdrawOnBankClientAccount::cannotBeNegative();
        }
        $accountBalance = $this->account->getBalance();
        if ($accountBalance->subtract($amount)->lessThan(Money::EUR(-500))) {
            throw UnableToMakeAWithdrawOnBankClientAccount::cannotWithdrawIfAccountIsUnder500();
        }
    }

    public function ensureValidDeposit(Money $amount)
    {

        if ($amount->isZero() || $amount === null) {
            throw UnableToMakeADepositOnBankClientAccount::cannotHaveNullAmount();
        }
        if ($amount->isNegative()) {
            throw UnableToMakeADepositOnBankClientAccount::cannotBeNegative();
        }
    }

}