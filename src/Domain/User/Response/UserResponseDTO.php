<?php

namespace App\Domain\User\Response;

use App\Domain\Shared\Response\BaseResponse;
use App\Domain\User\Entity\User;

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

    public function setUser(User $user): void
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
    }
}