<?php

namespace Metinet\Core\Security;

interface PasswordEncoder
{
    public function encode(string $password, string $salt): EncodedPassword;
}
