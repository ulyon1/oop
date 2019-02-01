<?php

namespace Metinet\Repositories;

use Metinet\Domain\Blog\BlogArticle;
use Metinet\Repositories\Exceptions\BlogArticleNotFound;

class BlogArticleSerializedFileRepository implements BlogArticleRepository
{
    private $path;
    /**
     * @var BlogArticle[]
     */
    private $blogArticles = [];

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->blogArticles = unserialize(file_get_contents($this->path));
    }

    public function save(BlogArticle $article): void
    {
        $this->blogArticles[$article->getId()] = $article;
        $this->persist();
    }

    public function get(string $id): BlogArticle
    {
        if (!isset($this->blogArticles[$id])) {

            throw new BlogArticleNotFound($id);
        }

        return $this->blogArticles[$id];
    }

    public function remove(BlogArticle $article): void
    {
        if (!isset($this->blogArticles[$article->getId()])) {
            throw new BlogArticleNotFound($article->getId());
        }

        unset($this->blogArticles[$article->getId()]);
        $this->persist();
    }

    private function persist(): void
    {
        if (file_put_contents($this->path, serialize($this->blogArticles)) < 1) {

            throw new \RuntimeException('Unable to persist blogArticle repository data');
        }
    }

    public function getLatestPosts(int $number): array
    {
        // TODO: Sort By date and limit by $number.
        return $this->blogArticles;
    }

    public function getAllPosts(): array
    {

        return $this->blogArticles;
    }
}
