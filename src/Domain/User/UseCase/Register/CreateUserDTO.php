<?php

namespace App\Domain\User\UseCase\Register;

readonly class CreateUserDTO
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
        public string $passwordConfirmation,
        public string $phoneNumber,
        public ?string $address = null,
    ) {
    }
}