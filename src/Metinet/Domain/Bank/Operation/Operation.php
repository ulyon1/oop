<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:24
 */

namespace Metinet\Domain\Bank\Operation;


interface Operation
{
    public function getAmount(): int;
    public function getDate();
}