<?php

namespace Metinet\Domain\Bank;

class Bank
{
    private $name;
    private $bankClients = [];

    function __construct(string $name)
    {
        $this->ensureNameNotEmpty($name);

        $this->name = $name;
    }

    public function addBankClient(BankClient $bankClient): BankClient
    {
        $this->bankClients[] = $bankClient;

        //On retourne le dernier client enregistré
        return $this->bankClients[count($this->bankClients) - 1];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function ensureNameNotEmpty(string $name): void
    {
        $name = trim($name);
        if( empty($name) ){
            throw new \Exception('The bank\'s name can not be empty');
        }
    }
}
