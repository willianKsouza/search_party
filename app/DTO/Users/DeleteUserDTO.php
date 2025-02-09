<?php

namespace App\DTO\Users;

class DeleteUserDTO
{
    public string $id;
    function __construct(string $id)
    {
        $this->id = $id;
    }
}
