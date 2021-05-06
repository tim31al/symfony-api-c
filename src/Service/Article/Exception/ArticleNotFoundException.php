<?php


use Symfony\Component\HttpFoundation\Response;

class ArticleNotFoundException extends AbstractArticleException
{
    protected $code = Response::HTTP_NOT_FOUND;
    protected $message = 'Article not found';
}
