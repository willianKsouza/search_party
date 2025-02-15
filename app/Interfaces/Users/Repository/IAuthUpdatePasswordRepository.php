<?php

namespace App\Interfaces\Users\Repository;

use App\DTO\Users\AuthUpdateDTO;

interface IAuthUpdatePasswordRepository
{
    public function update(AuthUpdateDTO $dto);
}
