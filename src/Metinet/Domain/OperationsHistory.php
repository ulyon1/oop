<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:22
 */

namespace Metinet\Domain;


class OperationsHistory
{
    private $operations;

    public function __construct($operations = [])
    {
        $this->operations = $operations;
    }

    public function add(Operation $operation)
    {
        $this->operations[] = $operation;
    }

    public function all(): array
    {
        return $this->operations;
    }
}