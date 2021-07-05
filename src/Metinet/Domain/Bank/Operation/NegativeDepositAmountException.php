<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:13
 */

namespace Metinet\Domain\Bank\Operation;


class NegativeDepositAmountException extends \Exception
{
    public static function handle()
    {
        return new self("Amount's value must be positive.");
    }
}