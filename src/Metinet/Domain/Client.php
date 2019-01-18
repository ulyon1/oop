<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 18/01/19
 * Time: 09:32
 */

namespace Metinet\Domain;


class Client
{
    private $id;
    private $lastName;
    private $firstName;

    /**
     * Client constructor.
     * @param $lastName
     * @param $firstName
     */
    public function __construct(string $lastName, string $firstName)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }


}