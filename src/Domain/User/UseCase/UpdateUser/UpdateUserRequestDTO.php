<?php

namespace App\Domain\User\UseCase\UpdateUser;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequestDTO
{
    public ?string $id = null;

    #[Assert\Length(min: 4)]
    public ?string $username = null;

    #[Assert\Email]
    public ?string $email = null;

}