<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:22
 */

namespace Metinet\Domain\Bank;


class BankClient
{

    private $firstName;
    private $lastName;

    public static function createClient(string $firstName, string $lastName):self {
        return new self($firstName, $lastName);
    }

    public function getFirstName():string
    {
        return $this->firstName;
    }

    public function getLastName():string
    {
        return $this->lastName;
    }

    private function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }


}