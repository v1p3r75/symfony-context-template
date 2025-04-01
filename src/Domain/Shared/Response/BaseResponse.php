<?php

namespace App\Domain\Shared\Response;

class BaseResponse
{
    public int $statusCode = 200;

    public string $message = 'Successfully';

    public array $errors = [];

    public function isSuccess(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    public function addError(string $name, string $detail): void
    {
        $this->errors[$name] = $detail;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}