<?php

namespace Metinet\Core\Security;

interface AccountProvider
{
    /**
     * @throws AccountNotFound When no account can be matched with $username
     */
    public function findByUsername(string $username): Account;
}
