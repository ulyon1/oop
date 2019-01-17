<?php

namespace Metinet\Domain\Blog\Comment;

class BadWordsDetected extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Bad words have been detected in your comment');
    }
}
