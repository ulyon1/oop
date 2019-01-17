<?php

namespace Metinet\Domain\Blog\Comment;

use PHPUnit\Framework\TestCase;

/** Trick to mock time in tests */
function time()
{
    return CommentTest::$now ?? \time();
}

class CommentTest extends TestCase
{
    public static $now;

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
        self::$now = time() - 4 * 60;
        $comment = Comment::post('Pline', 'Lorem ipsum dolor sid amet');
        self::$now = null;

        $this->expectException(UnableToEditComment::class);
        $this->expectExceptionMessageRegExp('/Comment can only be edited for \d+ seconds/');

        $comment->edit('Amet sid dolor ipsum lorem');
    }

    public function testACommentCannotBeEditedIfDeleted(): void
    {
        $this->expectException(UnableToEditComment::class);
        $this->expectExceptionMessage('A comment cannot be edited if it has been deleted');

        $comment = Comment::post('Pline', 'Lorem ipsum dolor sid amet');
        $comment->delete('No reason');
        $comment->edit('Amet sid dolor ipsum lorem');
    }

    public function testACommentCanBeEditedDuring3Minutes(): void
    {
        $comment = Comment::post('Pline', 'Lorem ipsum dolor sid amet');
        $editedBody = 'Amet sid dolor ipsum lorem';
        $comment->edit($editedBody);
        $this->assertEquals($editedBody, $comment->getBody());
    }

    public function testACommentCannotBeDeletedAfter10Minutes(): void
    {
        $this->expectException(UnableToDeleteComment::class);
        $this->expectExceptionMessageRegExp('/Comment can only be deleted for \d+ seconds/');

        self::$now = time() - 11 * 60;
        $comment = Comment::post('Pline', 'Lorem ipsum dolor sid amet');
        self::$now = null;
        $comment->delete('Some reason');
    }

    public function testACommentCannotBePostedWithBadWords(): void
    {
        $this->expectException(BadWordsDetected::class);
        $this->expectExceptionMessage('Bad words have been detected in your comment');

        $bodyWithBadWords = 'You are such a scumbag full of shit';
        Comment::post($bodyWithBadWords, 'Pline');
    }

    public function testADeletionReasonMustBeProvidedWhenDeletingAComment(): void
    {
        $comment = Comment::post('Pline', 'Lorem ipsum dolor sid amet');
        $deletionReason = 'Being an asshole';
        $comment->delete($deletionReason);

        $this->assertEquals($deletionReason, $comment->getDeletionReason());
    }

    public function testACommentCannotHaveAnEmptyBody(): void
    {
        $this->expectException(InvalidCommentBody::class);
        $this->expectExceptionMessage('Comment cannot have an empty body');
        $emptyBody = '';
        Comment::post($emptyBody, 'Pline');
    }

    public function testACommentCannotHaveABodyExceeding500Characters(): void
    {
        $this->expectException(InvalidCommentBody::class);
        $this->expectExceptionMessage('Comment cannot have a body exceeding 500 characters');

        Comment::post(str_repeat('x', 501), 'Pline');
    }
}
