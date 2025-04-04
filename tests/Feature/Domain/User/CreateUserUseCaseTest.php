<?php

namespace App\Tests\Feature\Domain\User;

use App\Domain\User\UseCase\Register\CreateUserUseCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateUserUseCaseTest extends KernelTestCase
{

    public function shouldCreateUser() {

        $kernel = self::bootKernel();
        $container = $kernel->getContainer();

        $useCase = CreateUserUseCase::class;


    }
}