<?php

namespace App\Domain\User\Response;

use App\Domain\Shared\Response\BaseResponse;

class UserResponseDTO extends BaseResponse
{

    public string $id;

    public string $username;

    public string $email;

    public function getData(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
        ];
    }

    public function setData(string $id, string $username, string $email): void
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }
}