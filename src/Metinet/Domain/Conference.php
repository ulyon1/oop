<?php

namespace Metinet\Domain;

class Conference
{
    private $details;
    private $date;
    private $location;
    private $maxAttendees;
    private $attendees;
    private $registrationRule;
    private $timeSlot;

    public function __construct(ConferenceDetails $details, Date $date, TimeSlot $timeSlot,
        Location $location, int $maxAttendees, RegistrationRule $registrationRule)
    {
        $this->details = $details;
        $this->date = $date;
        $this->timeSlot = $timeSlot;
        $this->location = $location;
        $this->maxAttendees = $maxAttendees;
        $this->attendees = [];
        $this->registrationRule = $registrationRule;
    }

    public function register(Attendee $attendee): void
    {
        $this->ensureConferenceHasNotReachedMaxAttendees();
        $this->attendees[] = $attendee;
    }

    private function ensureConferenceHasNotReachedMaxAttendees(): void
    {
        if ($this->hasMaxAttendeesBeenReached()) {

            throw new MaxAttendeesReached($this->maxAttendees);
        }
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

    public function getMaxAttendees(): int
    {
        return $this->maxAttendees;
    }

    public function hasMaxAttendeesBeenReached(): bool
    {
        return ($this->maxAttendees <= \count($this->attendees));
    }

    public function areExternalPeopleAllowed(): bool
    {
        return $this->registrationRule->areExternalPeopleAllowed();
    }

    public function getExternalPeopleEntrancePrice(): ?Price
    {
        return $this->registrationRule->getExternalPeopleEntrancePrice();
    }

    public function getDuration(): Time
    {
        return $this->timeSlot->getDuration();
    }
}
