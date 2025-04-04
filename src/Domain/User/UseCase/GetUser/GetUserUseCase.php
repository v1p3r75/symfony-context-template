<?php

namespace App\Domain\User\UseCase\GetUser;

use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Response\UserResponseDTO;
use Symfony\Component\HttpFoundation\Response;

readonly class GetUserUseCase
{

    public function __construct(
        private UserRepository $userRepository
    ){

    }

    public function execute(GetUserRequestDTO $request): UserResponseDTO
    {

        $response = new UserResponseDTO();
        $user = $this->userRepository->findOneBy(["id" => $request->id]);

        if (!$user) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setMessage("User not found");
            return $response;
        }

        $response->setData($user->getId(), $user->getUsername(), $user->getEmail());

        return $response;
    }
}