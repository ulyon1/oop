<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:13
 */

namespace Metinet\Domain\Bank;


class BankClient
{
    private $firstName;
    private $lastName;

    public static function register(string $firstName, string $lastName): BankClient
    {
        return new self($firstName,$lastName);
    }


    public function __construct(string $firstName,string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }


    public function getLastName(): string
    {
        return $this->lastName;
    }


}