<?php

namespace Metinet\Domain\Blog\Comment;

class UnableToDeleteComment extends \DomainException
{
    public static function allowedTimeForDeletionExpired(int $allowedTime): self
    {
        return new self(sprintf('Comment can only be deleted for %d seconds', $allowedTime));
    }
}
