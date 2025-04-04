<?php

namespace App\Domain\User\UseCase\DeleteUser;

use App\Domain\Shared\Response\DeleteResponseDTO;
use App\Domain\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserUseCase
{

    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function execute(DeleteUserRequestDTO $deleteUserRequestDTO): DeleteResponseDTO
    {
        $response = new DeleteResponseDTO();

        $user = $this->userRepository->findOneBy(['id' => $deleteUserRequestDTO->id]);

        if (!$user) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setMessage("user not found");

            return $response;
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return $response;
    }
}