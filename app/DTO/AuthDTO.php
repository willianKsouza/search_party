<?php

namespace App\DTO;

class AuthDTO
{
    public string $email;
    public string $password;
    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }
}
