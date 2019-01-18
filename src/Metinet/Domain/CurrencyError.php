<?php
/**
 * Created by PhpStorm.
 * User: lp.mathildeG
 * Date: 18/01/2019
 * Time: 10:34
 */

namespace Metinet\Domain;


class CurrencyError extends \DomainException
{
 public static function DifferentCurrency():self
 {
     return new self( sprintf("Different currency"));
 }
}