<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:43
 */

namespace Metinet\Domain\Bank;


class BankClientValidator{

    private $firstName;
    private $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function ensureBankClientHasNotEmptyFirstName(){
        if (empty($this->firstName)){
            throw UnableToCreateBankClient::unableToCreateWithEmptyFirstName();
        }
    }

    public function ensureBankClientHasNotEmptyLastName(){
        if (empty($this->lastName)){
            throw UnableToCreateBankClient::unableToCreateWithEmptyLastName();
        }
    }


}