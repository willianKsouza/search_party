<?php

namespace App\Interfaces\Users\Repository;

use App\DTO\Users\UpdateUserDTO;

interface IUpdateUsersRepository
{
    public function update(UpdateUserDTO $dto);
}
