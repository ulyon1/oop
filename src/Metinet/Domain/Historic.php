<?php

namespace Metinet\Domain;


class Historic
{
    private $operations;

    public function saveOperationAsHistoric(Operation $operation)
    {
        $operations[] = $operation;
    }
}