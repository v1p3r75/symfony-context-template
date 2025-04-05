<?php

namespace App\Domain\User\UseCase\Register;

use App\Domain\User\Entity\User;
use App\Domain\User\Message\EmailVerificationMessage;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Response\UserResponseDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class CreateUserUseCase
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
        private MessageBusInterface $messageBus,
    ){

    }

    /**
     * @throws ExceptionInterface
     */
    public function execute(CreateUserRequestDTO $request): UserResponseDTO
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

        $this->messageBus->dispatch(new EmailVerificationMessage($user->getEmail()));

        $response->setUser($user);

        return $response;
    }
}