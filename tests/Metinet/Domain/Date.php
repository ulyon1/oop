<?php

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
        if ($dateAsDateTime < new \DateTimeImmutable('now', new \DateTimeZone('UTC'))) {

            throw InvalidConferenceDate::mustNotBeInThePast();
        }

        $this->date = $dateAsDateTime;
    }

    public function __toString(): string
    {
        return $this->date->format('Y-m-d');
    }
}
