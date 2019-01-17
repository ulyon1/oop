<?php

namespace Metinet\Domain\Blog\Comment;

class InvalidCommentBody extends \DomainException
{
    public static function cannotHaveAnEmptyBody(): self
    {
        return new self('Comment cannot have an empty body');
    }

    public static function cannotHaveABodyExceeding500Characters(): self
    {
        return new self('Comment cannot have a body exceeding 500 characters');
    }
}
