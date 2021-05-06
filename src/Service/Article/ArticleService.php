<?php

namespace App\Service\Article;

use App\Entity\Article;
use ArticleBadDataException;
use ArticleNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ArticleService implements ArticleServiceInterface
{
    private EntityManagerInterface $entityManager;

    /**
     * ArticleService constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function getAll(): array
    {
        $articles = $this->entityManager
            ->getRepository(Article::class)
            ->findAll();

        $mapper = function ($article) {
            return $article->toArray();
        };

        return array_map($mapper, $articles);
    }

    /**
     * @throws \ArticleNotFoundException
     */
    public function getOne($id): array
    {
        try {
            $article = $this->entityManager
                ->getRepository(Article::class)
                ->find($id);
        } catch (Exception $e) {
            throw new ArticleNotFoundException();
        }

        return $article->toArray();
    }

    /**
     * @throws \ArticleBadDataException
     */
    public function create(array $raw): array
    {
        try {
            $title = $raw['title'];
            $body = $raw['body'];

            $article = new Article();
            $article->setTitle($title);
            $article->setBody($body);

            $this->entityManager->persist($article);
            $this->entityManager->flush();

            return $article->toArray();
        } catch (Exception $e) {
            throw new ArticleBadDataException();
        }
    }

    /**
     * @throws \ArticleNotFoundException
     */
    public function delete(int $id): bool
    {
        $article = $this->entityManager
            ->getRepository(Article::class)
            ->find($id);

        if (!$article) {
            throw new ArticleNotFoundException();
        }

        try {
            $this->entityManager->remove($article);
            $this->entityManager->flush();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
