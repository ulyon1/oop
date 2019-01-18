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
        $this->ensureBankClientHasNotEmptyFirstName($firstName);
        $this->ensureBankClientHasNotEmptyLastName($lastName);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    private function ensureBankClientHasNotEmptyFirstName($firstName){
        if (empty($firstName)){
            throw UnableToCreateBankClient::unableToCreateWithEmptyFirstName();
        }
    }

    private function ensureBankClientHasNotEmptyLastName($lastName){
        if (empty($lastName)){
            throw UnableToCreateBankClient::unableToCreateWithEmptyLastName();
        }
    }


}