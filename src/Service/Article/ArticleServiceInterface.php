<?php


namespace App\Service\Article;


interface ArticleServiceInterface
{
    public function getAll(): array;
    public function getOne(int $id): array;
    public function create(array $raw): array;
    public function delete(int $id): bool;
}
