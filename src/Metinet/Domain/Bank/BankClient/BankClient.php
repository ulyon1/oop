<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:26
 */

namespace Metinet\Domain\Bank\BankClient;

use Metinet\Domain\Bank\BankAccount\BankAccount;

class BankClient
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $bankAccount;

    public static function create(string $firstName, string $lastName, string $email, string $password, BankAccount $bankAccount)
    {
        return new self($firstName, $lastName, $email, $password, $bankAccount);
    }

    private function __construct(string $firstName, string $lastName, string $email, string $password, BankAccount $bankAccount)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->bankAccount = $bankAccount;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getBankAccount(): BankAccount
    {
        return $this->bankAccount;
    }


}