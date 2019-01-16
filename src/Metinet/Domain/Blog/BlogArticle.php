<?php

namespace Metinet\Domain\Blog;


use Metinet\Domain\Members\Member;

class BlogArticle
{
    private $author;
    private $title;
    private $body;
    private $postDate;

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


}