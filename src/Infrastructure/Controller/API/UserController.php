<?php

namespace App\Infrastructure\Controller\API;

use App\Domain\User\UseCase\DeleteUser\DeleteUserRequestDTO;
use App\Domain\User\UseCase\DeleteUser\DeleteUserUseCase;
use App\Domain\User\UseCase\GetUser\GetUserRequestDTO;
use App\Domain\User\UseCase\GetUser\GetUserUseCase;
use App\Domain\User\UseCase\ListUsers\ListUsersRequestDTO;
use App\Domain\User\UseCase\ListUsers\ListUsersUseCase;
use App\Domain\User\UseCase\Register\CreateUserRequestDTO;
use App\Domain\User\UseCase\Register\CreateUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;


class UserController extends AbstractController
{
    public function __construct(
        private readonly ListUsersUseCase  $listUsersUseCase,
        private readonly GetUserUseCase $getUserUseCase,
        private readonly CreateUserUseCase $createUserUseCase,
        private readonly DeleteUserUseCase $deleteUserUseCase,
    )
    {
    }

    #[Route(path: "/users", name: "users.index", methods: ["GET"])]
    public function index(
        #[MapQueryString] ListUsersRequestDTO $listUsersRequestDTO
    ): JsonResponse
    {

        $response = $this->listUsersUseCase->execute($listUsersRequestDTO);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "/users/{id}", name: "users.show", methods: ["GET"])]
    public function show(string $id): JsonResponse
    {
        $dto = new GetUserRequestDTO();
        $dto->id = $id;

        $response = $this->getUserUseCase->execute($dto);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "/users", name: "users.create", methods: ["POST"])]
    public function create(
        #[MapRequestPayload] CreateUserRequestDTO $userRequestDTO
    ): JsonResponse
    {

        $response = $this->createUserUseCase->execute($userRequestDTO);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "/users/{id}", name: "users.delete", methods: ["DELETE"])]
    public function delete(string $id): JsonResponse
    {
        $dto = new DeleteUserRequestDTO();
        $dto->id = $id;

        $response = $this->deleteUserUseCase->execute($dto);

        return $this->json($response, $response->getStatusCode());
    }

}