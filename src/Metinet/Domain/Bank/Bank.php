<?php

namespace Metinet\Domain\Bank;

class Bank
{
    private $name;

    function __construct(string $name)
    {
        $this->ensureNameNotEmpty($name);

        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function ensureNameNotEmpty(string $name): string
    {
        $name = trim($name);
        if( empty($name) ){
            throw new \Exception('The bank\'s name can not be empty');
        }
    }
}
