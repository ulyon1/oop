<?php

namespace Metinet\Tests\Metinet\Domain\Blog\Comment;

use PHPUnit\Framework\TestCase;
use Metinet\Domain\Blog\Comment\Comment;

class CommentTest extends TestCase
{
    public function testACommentCanBePosted(): void
    {
        $body = 'Lorem ipsum dolor sid amet';
        $author = 'Pline';

        $comment = Comment::post($body, $author);

        $this->assertEquals($body, $comment->getBody());
        $this->assertEquals($author, $comment->getAuthor());
    }

    public function testACommentCannotBeEditedAfter3Minutes(): void
    {

    }

    public function testACommentCanBeEditedDuring3Minutes(): void
    {

    }

    public function testACommentCannotBeDeletedAfter10Minutes(): void
    {

    }

    public function testACommentCannotBePostedWithBadWords(): void
    {

    }

    public function testADeletionReasonMustBeProvidedWhenDeletingAComment(): void
    {

    }

    public function testACommentCannotHaveAnEmptyBody(): void
    {

    }

    public function testACommentCannotHaveABodyExceeding500Characters(): void
    {

    }
}
