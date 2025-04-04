<?php

namespace App\Domain\User\UseCase\Register;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Response\UserResponseDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class CreateUserUseCase
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
    ){

    }
    public function execute(CreateUserDTO $request): UserResponseDTO
    {
        $response = new UserResponseDTO();

        $userExist = $this->userRepository->findOneBy(['email' => $request->email]);

        if ($userExist) {

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setError('email', 'email already exist');
            return $response;
        }

        $user = new User();
        $user->setUsername($request->username)
            ->setEmail($request->email)
            ->setPassword(
                $this->userPasswordHasher->hashPassword($user, $request->password)
            );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // You can't dispatch event here for send email, ...

        $response->setData($user->getId(), $user->getUsername(), $user->getEmail());

        return $response;
    }
}