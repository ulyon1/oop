<?php

namespace Metinet\FormValidation;

class ValidatorResults implements \Iterator
{
    private $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function all(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return (bool) \count($this->errors);
    }

    public function current()
    {
        return current($this->errors);
    }

    public function next()
    {
        next($this->errors);
    }

    public function key()
    {
        return key($this->errors);
    }

    public function valid()
    {
        return key($this->errors);
    }

    public function rewind()
    {
        reset($this->errors);
    }


}
