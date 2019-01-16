<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Security\Unauthorized;
use Metinet\Domain\Blog\BlogArticle;
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

        $member = $this->dependencyManager->getAuthenticationContext()->getAccount();

        //$blogArt = new BlogArticle($member, "Le système D, explications", "incroyable (New York Post) - sensationnel (Le Nouvel Obs)", new \DateTimeImmutable("05-08-2015"));

        //$blogArtRepo->save($blogArt);

        $latestPosts = $blogArtRepo->getLatestPosts(10);

        return $this->renderResponse('blog/latestPosts.html.twig', ['latestPosts' => $latestPosts]);
    }

    public function newBlogPost(Request $request): Response
    {
        return $this->renderResponse('blog/newBlogPost.html.twig', []);
    }
}
