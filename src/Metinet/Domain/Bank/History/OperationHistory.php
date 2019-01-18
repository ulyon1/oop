<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 11:01
 */

namespace Metinet\Domain\Bank\History;


use Metinet\Domain\Bank\Operation\Operation;
use Money\Money;

class OperationHistory
{
    private $operation;
    private $balance;

    public function __construct(Operation $operation, Money $balance)
    {
        $this->operation = $operation;
        $this->balance = $balance;
    }

    public function getOperation(): Operation
    {
        return $this->operation;
    }
    public function getBalance(): Money
    {
        return $this->balance;
    }
}