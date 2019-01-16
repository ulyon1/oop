<?php

namespace Metinet\Core\Security;

class Unauthorized extends \Exception
{
    public static function memberNotLoggedIn(): self
    {
        return new self('Member not logged in.');
    }
}
