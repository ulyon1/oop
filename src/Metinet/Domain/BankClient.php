<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 09:30
 */

namespace Metinet\Domain;


class BankClient
{
    private $firstName;
    private $lastName;
    private $history;

    private function __construct(string $firstName, string $lastName, History $history)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->history = $history;
    }

    public static function register(string $firstName, string $lastName, History $history):self
    {
        return new self($firstName,$lastName, $history);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return History
     */
    public function getHistory()
    {
        return $this->history;
    }


}