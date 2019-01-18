<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 18/01/2019
 * Time: 09:56
 */

namespace Metinet\Domain;

class Date
{
    private $date;

    public static function fromAtomFormat(string $date): self
    {
        return new self($date);
    }

    private function __construct(string $date)
    {
        $dateAsDateTime = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s 00:00:01', $date));
        $this->date = $dateAsDateTime;
    }

    public function __toString(): string
    {
        return $this->date->format('Y-m-d H:i');
    }
}