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
use App\Domain\User\UseCase\UpdateUser\UpdateUserRequestDTO;
use App\Domain\User\UseCase\UpdateUser\UpdateUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;


#[Route("/users", name: "users.")]
class UserController extends AbstractController
{
    public function __construct(
        private readonly ListUsersUseCase  $listUsersUseCase,
        private readonly GetUserUseCase $getUserUseCase,
        private readonly CreateUserUseCase $createUserUseCase,
        private readonly UpdateUserUseCase $updateUserUseCase,
        private readonly DeleteUserUseCase $deleteUserUseCase,
    )
    {
    }

    #[Route(path: "", name: "index", methods: ["GET"])]
    public function index(
        #[MapQueryString] ListUsersRequestDTO $listUsersRequestDTO
    ): JsonResponse
    {

        $response = $this->listUsersUseCase->execute($listUsersRequestDTO);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "/{id}", name: "show", methods: ["GET"])]
    public function show(string $id): JsonResponse
    {
        $dto = new GetUserRequestDTO();
        $dto->id = $id;

        $response = $this->getUserUseCase->execute($dto);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "", name: "create", methods: ["POST"])]
    public function create(
        #[MapRequestPayload] CreateUserRequestDTO $userRequestDTO
    ): JsonResponse
    {

        $response = $this->createUserUseCase->execute($userRequestDTO);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "/{id}", name: "update", methods: ["PATCH"])]
    public function update(
        string $id,
        #[MapRequestPayload] UpdateUserRequestDTO $userRequestDTO
    ): JsonResponse
    {
        $userRequestDTO->id = $id;

        $response = $this->updateUserUseCase->execute($userRequestDTO);

        return $this->json($response, $response->getStatusCode());
    }

    #[Route(path: "/{id}", name: "delete", methods: ["DELETE"])]
    public function delete(string $id): JsonResponse
    {
        $dto = new DeleteUserRequestDTO();
        $dto->id = $id;

        $response = $this->deleteUserUseCase->execute($dto);

        return $this->json($response, $response->getStatusCode());
    }

}