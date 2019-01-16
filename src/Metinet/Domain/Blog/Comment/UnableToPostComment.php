<?php

namespace Metinet\Domain\Blog\Comment;

class UnableToPostComment extends \DomainException
{
    public static function cannotPostWithAnEmptyBody(): self
    {
        return new self('Cannot post a Comment with an empty body');
    }
}
