<?php

namespace App\Tests\Feature\Domain\User;

use App\Domain\User\Repository\UserRepository;
use App\Domain\User\UseCase\Register\CreateUserRequestDTO;
use App\Domain\User\UseCase\Register\CreateUserUseCase;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class CreateUserUseCaseTest extends KernelTestCase
{

    public function testShouldCreateUserSuccessfully(): void
    {


    }
}