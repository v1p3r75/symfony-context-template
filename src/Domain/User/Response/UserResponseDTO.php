<?php

namespace App\Domain\User\Response;

use App\Domain\Shared\Response\BaseResponse;

class UserResponseDTO extends BaseResponse
{

    public string $id;

    public string $username;

    public string $email;

}