<?php

class Post
{
  private $title;
  private $author;
  private $date;
  private $description;

  function __construct(string $title, string $author, string $description)
  {
    $this->title = $title;
    $this->author = $author;
    $this->description = $description;

    $this->date = date('Y-m-d H:i:s');
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getAuthor()
  {
    return $this->$author;
  }

  public function getDate()
  {
    return $this->author;
  }

  public function getDescription()
  {
    return $this->description;
  }
}
