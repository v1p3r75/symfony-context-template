<?php

namespace App\Domain\User\UseCase\Register;

use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

readonly class CreateUserDTO
{
    #[NotBlank]
    #[Length(min: 4)]
    public string $username;

    #[NotBlank]
    public string $email;

    #[NotBlank]
    #[Length(min: 6, max: 255)]
    public string $password;

    #[NotBlank]
    #[EqualTo(propertyPath: 'password')]
    public string $passwordConfirmation;

}