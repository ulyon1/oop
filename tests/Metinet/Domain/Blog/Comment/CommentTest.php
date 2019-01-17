<?php

namespace Metinet\Tests\Metinet\Domain\Blog\Comment;

use Metinet\Domain\Blog\Comment\BadWordsDetected;
use Metinet\Domain\Blog\Comment\UnableToPostComment;
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
        $this->expectException(BadWordsDetected::class);
        $this->expectExceptionMessage('Bad words have been detected in your comment');

        $bodyWithBadWords = 'You are such a scumbag full of shit';
        $author = 'Pline';
        Comment::post($bodyWithBadWords, $author);
    }

    public function testADeletionReasonMustBeProvidedWhenDeletingAComment(): void
    {

    }

    public function testACommentCannotHaveAnEmptyBody(): void
    {
        $this->expectException(UnableToPostComment::class);

        $this->expectExceptionMessage('Cannot post a Comment with an empty body');
        $emptyBody = '';
        $author = 'Pline';
        $comment = Comment::post($emptyBody, $author);

        $this->assertNotEmpty($comment->getBody());
    }

    public function testACommentCannotHaveABodyExceeding500Characters(): void
    {

    }
}
