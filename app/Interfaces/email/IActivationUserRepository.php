<?php

namespace App\Interfaces\email;

use App\DTO\Users\ActivationUserDTO;
use Exception;

interface IActivationUserRepository
{
    public function sendActivationUser(ActivationUserDTO $dto): bool;
}
