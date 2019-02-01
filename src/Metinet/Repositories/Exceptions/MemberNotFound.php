<?php

namespace Metinet\Repositories;

class MemberNotFound extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Member #%s not found', $id));
    }
}
