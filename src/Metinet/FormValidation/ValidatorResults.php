<?php

namespace Metinet\FormValidation;

class ValidatorResults implements \IteratorAggregate
{
    private $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function hasErrors(): bool
    {
        return (bool) \count($this->errors);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->errors);
    }

}
