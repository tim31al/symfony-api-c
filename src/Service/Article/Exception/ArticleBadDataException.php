<?php


use Symfony\Component\HttpFoundation\Response;

class ArticleBadDataException extends AbstractArticleException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Bad data';
}
