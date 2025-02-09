<?php

namespace App\Interfaces\Users\Services;

use App\DTO\Users\UpdateUserDTO;

interface IUpdateUserService
{
    public function execute(UpdateUserDTO $dto);
}
