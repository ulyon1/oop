<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:26
 */

namespace Metinet\Domain\Bank\History;


use Metinet\Domain\Bank\Operation\Operation;
use Money\Money;

class History
{
    private $operationsList = [];

    public function addOperation(Operation $operation, Money $balance)
    {
        $this->operationsList[] = new OperationHistory($operation, $balance);
    }

    public function getLastOperation(): OperationHistory
    {
        return $this->operationsList[ count($this->operationsList) - 1];
    }

    public function getHistory(): array
    {
        return $this->operationsList;
    }
}