<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:41
 */

namespace Metinet\Domain\Operation;


class DepositOperation extends Operation
{
    public function __construct($amount, $balance)
    {
        parent::__construct($amount, $balance);
    }
}