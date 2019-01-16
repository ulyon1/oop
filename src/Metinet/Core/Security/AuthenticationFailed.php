<?php

namespace Metinet\Core\Security;

class AuthenticationFailed extends \Exception
{
    public static function invalidPassword(Account $account)
    {
        return new self(sprintf('Account "%s" failed to authenticate, invalid password provided', $account->getUsername()));
    }
    public static function accountNotFound(string $username)
    {
        return new self(sprintf('Account with username "%s" was not found.', $username));
    }
}
