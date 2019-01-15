<?php

namespace Metinet\Domain;

class Conference
{
    private $seatsAvailable;
    private $details;
    private $date;
    private $location;
    private $participants;

    public function __construct(int $seatsAvailable, ConferenceDetails $details, Date $date, Location $location, array $participants)
    {
        $this->ensureParticipants($participants);

        $this->seatsAvailable = $seatsAvailable;
        $this->details = $details;
        $this->date = $date;
        $this->location = $location;
        $this->participants = $participants;
    }

    public function getSeatsAvailable(): int
    {
        return $this->seatsAvailable;
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

    public function getParticipants(): array
    {
        return $this->participants;
    }

    public function ensureParticipants(array $participants): void
    {
        foreach ($participants as $participant){
            if(get_class($participant) !== ConferenceParticipant::class) {
                throw new \InvalidArgumentException('Invalid array of participants');
            }
        }
    }


}
