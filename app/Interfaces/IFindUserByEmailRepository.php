<?php

namespace App\interfaces;

use App\DTO\AuthDTO;

interface IFindUserByEmailRepository
{
    public function login(string|AuthDTO $data);
}
