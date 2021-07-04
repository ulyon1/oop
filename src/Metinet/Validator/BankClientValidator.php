<?php

namespace Metinet\Validator;

use Metinet\Entity\BankClient;

class BankClientValidator
{
    public static function validate(BankClient $bankClient)
    {
        $errors = [];

        if (strlen($bankClient->getFirstname()) < 1) {
            $errors[] = 'The BankClient::firstname must container at least one character.';
        }

        if (strlen($bankClient->getLastname()) < 1) {
            $errors[] = 'The BankClient::lastname must container at least one character.';
        }

        return $errors;
    }
}
