<?php
namespace Metinet\Domain\Bank;

/**
 *
 */
class Bank
{
    private $name;
    private $listBankClient = [];

    function __construct(string $name)
    {
        $this -> name = $name;
    }

    public function getName(): string{
        return $this -> name;
    }

    public function addBankClient(Client $client):void{
        // on test si le client a un nom et prenom avant de l'ajouter
        $this -> listBankClient[] = $client;

    }
}
