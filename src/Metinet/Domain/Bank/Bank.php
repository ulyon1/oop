<?php

namespace Metinet\Domain\Bank;

class Bank
{
    private $name;

    function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
