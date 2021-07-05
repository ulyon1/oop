<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:12
 */
class WithDrawalTest extends \PHPUnit\Framework\TestCase
{
    public function testDepositDateIsValid()
    {
        $deposit = new \Metinet\Domain\Bank\Operation\Deposit(100);

        $this->assertEquals(date("d-m-Y"), $deposit->getDate());
    }

    public function testWithDrawalAmountIsPositive()
    {
        $this->expectException(\Metinet\Domain\Bank\Operation\NegativeDepositAmountException::class);
        $this->expectExceptionMessage("Amount's value must be positive.");

        $withDrawal = new \Metinet\Domain\Bank\Operation\WithDrawal(-100);
    }

}