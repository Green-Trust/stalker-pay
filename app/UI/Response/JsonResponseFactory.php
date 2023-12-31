<?php

namespace App\UI\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseFactory
{
    public function success(string $message = '', array $data = []): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ]);
    }

    public function error(string $message = '', array $data = [], int $code = Response::HTTP_FORBIDDEN): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}
