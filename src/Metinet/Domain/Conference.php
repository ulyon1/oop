<?php

namespace Metinet\Domain;

class Conference
{
    private $title;
    private $description;
    private $date;

    public function __construct(string $title, string $description, \DateTimeImmutable $date)
    {
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
