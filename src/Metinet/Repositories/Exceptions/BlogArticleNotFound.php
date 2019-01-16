<?php

namespace Metinet\Repositories\Exceptions;

class BlogArticleNotFound extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('BlogArticle #%s not found', $id));
    }
}
