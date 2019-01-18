<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:10
 */
class BankClientTest extends \PHPUnit\Framework\TestCase {

    public function testClientMakingADeposit()
    {
        $client = new \Metinet\Domain\Bank\BankClient("firstname", "lastname");

        $client->makeDeposit(100);

        $this->assertEquals(100, $client->getAccount()->getOperationHistory()->getLastOperation()->getOperation()->getAmount());
        $this->assertEquals(date("d-m-Y"), $client->getAccount()->getOperationHistory()->getLastOperation()->getOperation()->getDate());
    }

    // On test si le montant stocké par l'account évolue bien au fil des opérations
    public function testClientAccount()
    {
        $client = new \Metinet\Domain\Bank\BankClient("firstname", "lastname");

        $client->makeDeposit(100);
        $client->makeDeposit(200);

        $this->assertEquals(300, $client->getAccount()->getCurrentMoney()->getAmount());
    }

    public function textClientAccountOperationHistory()
    {
        $client = new \Metinet\Domain\Bank\BankClient("firstname", "lastname");

        $client->makeDeposit(100);
        $client->makeDeposit(200);

        $this->assertEquals(200, $client->getAccount()->getOperationHistory()->getLastOperation()->getOperation()->getAmount());
        $this->assertEquals(2, count($client->getAccount()->getOperationHistory()->getHistory()));
    }


}