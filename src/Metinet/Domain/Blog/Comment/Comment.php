<?php

namespace Metinet\Domain\Blog\Comment;

class Comment
{
    private $body;
    private $author;

    public static function post(string $body, string $author): Comment
    {
        return new self($body, $author);
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    private function __construct(string $body, string $author)
    {
        $this->body = $body;
        $this->author = $author;
    }
}
