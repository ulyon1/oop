<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Security\Unauthorized;
use Metinet\Domain\Blog\BlogArticle;
use Metinet\Domain\Blog\Comment\Comment;
use Metinet\Domain\Members\Member;

class BlogController extends BaseController
{
    public function latestPosts(Request $request): Response
    {
        $blogArtRepo = $this->dependencyManager->getBlogArticleRepository();

        if($this->dependencyManager->getSession()->get('account') === null)
        {
           throw Unauthorized::memberNotLoggedIn();
        }

        //$member = $this->dependencyManager->getAuthenticationContext()->getAccount();

        //$blogArt = new BlogArticle($member, "Klaxoon, meilleure app web", "orlme msupi", new \DateTimeImmutable("05-08-2015"));
        //$blogArt->addComment(Comment::post('Le gras, c\'est la vie', "Karadoc"));
        //$blogArt->addComment(Comment::post('oui mais j\'aime pas les harengs.', "Perceval"));

        //$blogArtRepo->save($blogArt);

        $latestPosts = $blogArtRepo->getLatestPosts(10);

        return $this->renderResponse('blog/latestPosts.html.twig', ['latestPosts' => $latestPosts]);
    }

    public function newBlogPost(Request $request): Response
    {
        return $this->renderResponse('blog/newBlogPost.html.twig', []);
    }
}
