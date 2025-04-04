<?php

namespace App\Infrastructure\Controller\API;

use App\Domain\User\UseCase\Register\CreateUserDTO;
use App\Domain\User\UseCase\Register\CreateUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

    
class UserController extends AbstractController
{
    public function __construct(
        private readonly CreateUserUseCase $createUserUseCase,
    )
    {
    }

    #[Route(path: "/users", name: "users.create", methods: ["POST"])]
    public function create(
        #[MapRequestPayload] CreateUserDTO $createUserDTO
    ): JsonResponse
    {

        $response = $this->createUserUseCase->execute($createUserDTO);

        return new JsonResponse($response);
    }

}