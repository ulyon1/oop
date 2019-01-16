<?php

namespace Metinet\Repositories;

use Metinet\Domain\Blog\BlogArticle;

interface BlogArticleRepository
{
    public function save(BlogArticle $article): void;
    public function remove(BlogArticle $article): void;
    public function get(string $id): BlogArticle;
    public function getLatestPosts(int $number): array;
    public function getAllPosts(): array;
}