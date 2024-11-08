<?php

namespace App\Interfaces;

use App\DTO\CreateUserDTO;

interface ICreateUser
{
    public function create(CreateUserDTO $user);
}
