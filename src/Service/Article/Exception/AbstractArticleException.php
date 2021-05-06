<?php


use App\Exception\ApiExceptionInterface;


abstract class AbstractArticleException extends Exception implements ApiExceptionInterface
{

    public function getStatusCode(): int
    {
        return $this->getCode();
    }

    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }
}
