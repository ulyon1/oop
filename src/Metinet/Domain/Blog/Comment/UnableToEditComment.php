<?php

namespace Metinet\Domain\Blog\Comment;

class UnableToEditComment extends \DomainException
{
    public static function allowedTimeForEditionExpired($allowedTime): self
    {
        return new self(sprintf('Comment can only be edited for %d seconds', $allowedTime));
    }
}
