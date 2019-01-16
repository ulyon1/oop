<?php

namespace Metinet\Core\Security;

class AccountNotFound extends \Exception
{
    public function __construct(string $username)
    {
        parent::__construct(sprintf('No account found for username: "%s"', $username));
    }
}
