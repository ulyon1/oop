<?php

namespace Metinet\Domain;

class Conference
{
    private $details;
    private $date;
    private $location;

    public function __construct(ConferenceDetails $details, Date $date, Location $location)
    {
        $this->details = $details;
        $this->date = $date;
        $this->location = $location;
    }

    public function getDetails(): ConferenceDetails
    {
        return $this->details;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }
}
