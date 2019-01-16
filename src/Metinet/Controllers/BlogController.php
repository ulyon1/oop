<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;

class BlogController extends BaseController
{
    public function latestPosts(Request $request): Response
    {
        return $this->renderResponse('blog/latestPosts.html.twig', []);
    }

    public function newBlogPost(Request $request): Response
    {
        return $this->renderResponse('blog/newBlogPost.html.twig', []);
    }
}
