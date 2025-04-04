<?php

namespace App\Domain\User\UseCase\Register;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 4)]
    public ?string $username = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    public ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 255)]
    public ?string $password = null;

    #[Assert\NotBlank]
    #[Assert\EqualTo(propertyPath: 'password')]
    public ?string $passwordConfirmation = null;

}