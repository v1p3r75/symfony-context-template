<?php

namespace App\Domain\User\UseCase\GetUser;


use Symfony\Component\Validator\Constraints as Assert;

class GetUserRequestDTO
{
    #[Assert\NotBlank()]
    #[Assert\Type('string')]
    public ?string $id = null;
}