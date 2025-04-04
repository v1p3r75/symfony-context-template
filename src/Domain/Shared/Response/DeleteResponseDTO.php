<?php

namespace App\Domain\Shared\Response;

use App\Domain\Shared\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteResponseDTO extends BaseResponse
{

    public function __construct()
    {
        $this->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    public function getData(): array
    {
        return [];
    }
}