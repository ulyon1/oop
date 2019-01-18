<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:24
 */

namespace Metinet\Domain\Bank\Operation;


class WithDrawal implements Operation
{
    private $amount;
    private $date;

    public function __construct(int $amount)
    {

        $this->checkAmount($amount);

        $this->amount = $amount;
        $this->date = date("d-m-Y");
    }

    private function checkAmount(int $amount)
    {
        if ($amount < 0) {
            throw NegativeDepositAmountException::handle();
        }
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDate()
    {
        return $this->date;
    }
}