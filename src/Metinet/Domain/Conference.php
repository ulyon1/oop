<?php

namespace Metinet\Domain;

class Conference
{
    private $details;
    private $date;

    public function __construct(ConferenceDetails $details, Date $date)
    {
        $this->details = $details;
        $this->date = $date;
    }

    public function getDetails(): ConferenceDetails
    {
        return $this->details;
    }

    public function getDate(): Date
    {
        return $this->date;
    }
}
