<?php

namespace App\Interfaces\Users\Repository;

use App\DTO\Users\DeleteUserDTO;

interface IDeleteUserRepository
{
    public function delete(DeleteUserDTO $dto);
}
