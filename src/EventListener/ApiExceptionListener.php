<?php


namespace App\EventListener;


use App\Exception\ApiExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {

        $exception = $event->getThrowable();
        if (!$exception instanceof ApiExceptionInterface) {
            return;
        }

        $response = new JsonResponse(
            ['error' => $exception->getErrorMessage()],
            $exception->getStatusCode()
        );

        $event->setResponse($response);
    }
}

