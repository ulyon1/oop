<?php
namespace Metinet\Domain;

class ErrorsUncovered extends \DomainException
{
    public static function cannotHaveThisUncovered(): self
    {
        return new self('Bank Client cannot have this uncovered !');
    }
}