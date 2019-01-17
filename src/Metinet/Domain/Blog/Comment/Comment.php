<?php

namespace Metinet\Domain\Blog\Comment;

class Comment
{
    private $body;
    private $author;

    public const BAD_WORDS = ['fuck', 'whore', 'shit', 'scum'];

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

    private function ensureNoBadWords(string $body)
    {
        $badWordsFoundCount = count(
            array_intersect(
                array_map('strtolower', self::BAD_WORDS),
                explode(' ', preg_replace("/[^A-Za-z0-9' -]/",'', strtolower($body)))
            )
        );

        if ($badWordsFoundCount > 0) {

            throw new BadWordsDetected();
        }
    }

    private function __construct(string $body, string $author)
    {
        if (empty($body)) {

            throw UnableToPostComment::cannotPostWithAnEmptyBody();
        }

        $this->ensureNoBadWords($body);

        $this->body = $body;
        $this->author = $author;
    }
}
