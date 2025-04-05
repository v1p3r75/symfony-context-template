<?php

namespace App\Domain\User\UseCase\ListUsers;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Response\UserResponseDTO;

readonly class ListUsersUseCase
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function execute(ListUsersRequestDTO $request): ListUsersResponseDTO
    {
        $users = $this->userRepository->findAll();

        $response = new ListUsersResponseDTO();

        array_map(function (User $user) use ($response) {

            $userDto = new UserResponseDTO();
            $userDto->setUser($user);
            $response->addUser($userDto);

        }, $users);

        return $response;
    }
}