<?php

namespace Metinet\Domain;

class MaxAttendeesReached extends \DomainException
{
    public function __construct(int $maxAttendees)
    {
        parent::__construct(sprintf('Max attendees reached (max: %d)', $maxAttendees));
    }
}
