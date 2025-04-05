<?php

namespace App\Domain\User\UseCase\UpdateUser;

use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Response\UserResponseDTO;
use Doctrine\ORM\EntityManagerInterface;

readonly class UpdateUserUseCase
{
    public function __construct(
        private UserRepository         $userRepository,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function execute(UpdateUserRequestDTO $updateUserRequestDTO): UserResponseDTO
    {
        $response = new UserResponseDTO();
        $user = $this->userRepository->findOneBy(['id' => $updateUserRequestDTO->id]);

        if(!$user) {
            $response->setNotFoundStatus();
            return $response;
        }

        if ($updateUserRequestDTO->email) {
            $user->setEmail($updateUserRequestDTO->email);
        }
        if ($updateUserRequestDTO->username) {
            $user->setUsername($updateUserRequestDTO->username);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $response->setUser($user);

        return $response;
    }
}