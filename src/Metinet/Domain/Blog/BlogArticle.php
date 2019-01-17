<?php

namespace Metinet\Domain\Blog;


use Metinet\Domain\Blog\Comment\Comment;
use Metinet\Domain\Members\Member;

class BlogArticle
{
    private $author;
    private $title;
    private $body;
    private $postDate;
    private $comments;

    /**
     * BlogArticle constructor.
     * @param $author
     * @param $title
     * @param $body
     * @param $postDate
     */
    public function __construct(Member $author, string $title, string $body, \DateTimeImmutable $postDate)
    {
        $this->id = uniqid();
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
        $this->postDate = $postDate;
        $this->comments = [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Member
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    public function getPostDate(string $format): string
    {
        return $this->postDate->format($format);
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }

    public function getComments()
    {
        return $this->comments;
    }
}