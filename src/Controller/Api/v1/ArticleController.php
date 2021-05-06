<?php

namespace App\Controller\Api\v1;

use App\Service\Article\ArticleServiceInterface;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Article;


class ArticleController extends AbstractController
{
    private ArticleServiceInterface $articleService;

    /**
     * ArticleController constructor.
     * @param \App\Service\Article\ArticleServiceInterface $articleService
     */
    public function __construct(ArticleServiceInterface $articleService)
    {
        $this->articleService = $articleService;
    }


    /**
     * Список статей
     *
     * @Route("/api/v1/articles", methods={"GET"}, name="api.articles")
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает все статьи",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     * @SWG\Tag(name="articles")
     */
    public function index(): Response
    {
        $articles = $this->articleService->getAll();
        return $this->json($articles);
    }

    /**
     * Статья
     *
     * @Route("/api/v1/articles/{id}", methods={"GET"}, name="api.article")
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает статью по id",
     *     @SWG\Schema(ref=@Model(type=Article::class))
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not found"
     * )
     * @SWG\Tag(name="article")
     */
    public function show($id): Response
    {
        $article = $this->articleService->getOne($id);
        return $this->json($article);
    }

    /**
     * Добавить статью
     *
     * @Route("/api/v1/articles", methods={"POST"}, name="api.article.add")
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает статью по id",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     * @SWG\Tag(name="create article")
     */
    public function create(Request $request): Response
    {
        $article = $this->articleService->create($request->toArray());
        return $this->json($article);
    }

    /**
     * @Annotations\Post("")
     *
     * @OA\Post(
     *     tags={"Твиты"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="authorId", type="integer", description="ID автора", example="123"),
     *                 @OA\Property(property="text", type="string", description="Текст твита", example="My tweet"),
     *             )
     *         )
     *     )
     * )
     *
     * @RequestParam(name="authorId", requirements="\d+")
     * @RequestParam(name="text")
     */

    /**
     * Удалить статью
     *
     * @Route("/api/v1/articles", methods={"DELETE"}, name="api.article.delete")
     * @SWG\Response(
     *     response=200,
     *     description="Статья удалена",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     * @SWG\Tag(name="delete article")
     */
    public function delete(int $id): Response
    {
        $success = $this->articleService->delete($id);
        return $this->json(['success' => $success]);
    }
}
