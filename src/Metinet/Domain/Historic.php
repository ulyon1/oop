<?php

namespace Metinet\Domain;

use Metinet\Domain\Operation\Operation;

class Historic
{
    private $operations;

    public function saveOperation(Operation $operation)
    {
        $operations[] = $operation;
    }

    public function getOperations()
    {
        return $this->operations;
    }
}