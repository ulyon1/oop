<?php

namespace Metinet\Core\Security;

interface Account
{
    public function getUsername(): string;
    public function getEncodedPassword(): EncodedPassword;
}
