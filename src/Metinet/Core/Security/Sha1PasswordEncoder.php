<?php

namespace Metinet\Core\Security;

class Sha1PasswordEncoder implements PasswordEncoder
{
    public function encode(string $password, string $salt): EncodedPassword
    {
        $hashedPassword = sha1(sprintf('%s{%s}', $password, $salt));

        return new EncodedPassword($hashedPassword, $salt);
    }
}
