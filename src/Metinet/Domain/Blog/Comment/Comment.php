<?php

namespace Metinet\Domain\Blog\Comment;

class Comment
{
    private $body;
    private $author;
    private $postedOn;
    private $deletionReason;

    private const DELAY_TO_EDIT_IN_SECONDS = 60 * 3;
    private const DELAY_TO_DELETE_IN_SECONDS = 60 * 10;

    public static function post(string $body, string $author): Comment
    {
        return new self($body, $author, \DateTimeImmutable::createFromFormat('U', time(), new \DateTimeZone('UTC')));
    }

    public function edit(string $body): void
    {
        $now = \DateTimeImmutable::createFromFormat('U', time(), new \DateTimeZone('UTC'))->format('U');
        $postedOnTime = $this->postedOn->format('U');

        if (($now - $postedOnTime) > self::DELAY_TO_EDIT_IN_SECONDS) {

            throw UnableToEditComment::allowedTimeForEditionExpired(self::DELAY_TO_EDIT_IN_SECONDS);
        }

        $this->body = $body;
    }

    public function delete(string $deletionReason): void
    {
        $now = \DateTimeImmutable::createFromFormat('U', time(), new \DateTimeZone('UTC'))->format('U');
        $postedOnTime = $this->postedOn->format('U');

        if (($now - $postedOnTime) > self::DELAY_TO_DELETE_IN_SECONDS) {

            throw UnableToDeleteComment::allowedTimeForDeletionExpired(self::DELAY_TO_DELETE_IN_SECONDS);
        }

        $this->deletionReason = $deletionReason;
    }

    public function getDeletionReason(): string
    {
        return $this->deletionReason;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPostedOn(): \DateTimeImmutable
    {
        return $this->postedOn;
    }

    private function __construct(string $body, string $author, \DateTimeImmutable $postedOn)
    {
        $this->ensureValidBody($body);
        $this->ensureNoBadWords($body);

        $this->body = $body;
        $this->author = $author;
        $this->postedOn = $postedOn;
    }

    private function ensureValidBody(string $body): void
    {
        if (empty($body)) {

            throw InvalidCommentBody::cannotHaveAnEmptyBody();
        }

        if (strlen($body) > 500) {

            throw InvalidCommentBody::cannotHaveABodyExceeding500Characters();
        }
    }

    public const BAD_WORDS = ['fuck', 'whore', 'shit', 'scum'];

    private function ensureNoBadWords(string $body): void
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
}
