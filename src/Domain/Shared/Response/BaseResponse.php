<?php

namespace App\Domain\Shared\Response;

use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseResponse implements JsonSerializable
{
    private int $statusCode = 200;

    private string $message = 'Successfully';

    private array $errors = [];

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;

        if (!$this->isSuccess()) {
            $this->setMessage('An error occurred');
        }
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function isSuccess(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    public function setError(string $name, string $detail): void
    {
        $this->errors[$name] = $detail;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setNotFoundStatus(): void
    {
        $this->statusCode = Response::HTTP_NOT_FOUND;
    }

    abstract public function getData(): array;

    public function jsonSerialize() : array
    {
        $jsonData = [
            'status' => $this->getStatusCode(),
            'message' => $this->getMessage(),
        ];

        if ($this->isSuccess()) {
            $jsonData['data'] = $this->getData();
        } else {
            $jsonData['errors'] = $this->getErrors();
        }

        return $jsonData;
    }


}