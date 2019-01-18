<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 10:25
 */

namespace Metinet\Domain\Bank;


class OperationNotAllowed extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Sorry but this type of operation is not allowed. You can type : deposit, withdrawal, checkOperation');
    }
}