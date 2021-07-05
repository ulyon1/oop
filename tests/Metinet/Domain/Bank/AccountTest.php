<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:10
 */
class AccountTest extends \PHPUnit\Framework\TestCase
{
    public function testDeposit()
    {
        $account = new \Metinet\Domain\Bank\Account();


        $account->deposit(100);

        $this->assertEquals(100, $account->getCurrentMoney()->getAmount());
        $this->assertEquals(100, $account->getOperationHistory()->getLastOperation()->getOperation()->getAmount());
    }

    public function testWithDrawal()
    {
        $account = new \Metinet\Domain\Bank\Account();


        $account->deposit(100);
        $account->withDrawal(50);

        $this->assertEquals(50, $account->getCurrentMoney()->getAmount());
        $this->assertEquals(50, $account->getOperationHistory()->getLastOperation()->getOperation()->getAmount());
    }
}