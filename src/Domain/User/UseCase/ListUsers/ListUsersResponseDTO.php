<?php

namespace App\Domain\User\UseCase\ListUsers;

use App\Domain\Shared\Response\BaseResponse;
use App\Domain\User\Response\UserResponseDTO;

class ListUsersResponseDTO extends BaseResponse
{

    public array $users = [];

    public function getData(): array
    {
        return $this->users;
    }

    public function addUser(UserResponseDTO $userResponseDTO): void
    {
        $this->users[] = $userResponseDTO->getData();
    }
}