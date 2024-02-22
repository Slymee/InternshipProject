<?php
declare(strict_types=1);

namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable
{
    public function __construct(
        private mixed $data,
        private array $metaData,
        private int $statusCode = Response::HTTP_CREATED,
        private array $headers = [],
        private int $options = 0
    )
    {

    }

    public function toResponse($request): JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        return response()->json(
            [
                'data' => $this->data,
                'metaData' => $this->metaData
            ],
            $this->statusCode,
            $this->headers,
            $this->options
        );
    }
}
