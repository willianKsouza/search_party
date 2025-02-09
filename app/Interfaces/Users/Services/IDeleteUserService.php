<?php

namespace App\Interfaces\Users\Services;

use App\DTO\Users\DeleteUserDTO;

interface IDeleteUserService
{
    public function execute(DeleteUserDTO $dto);
}
