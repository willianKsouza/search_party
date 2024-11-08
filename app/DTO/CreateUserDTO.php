<?php

namespace App\DTO;


class CreateUserDTO
{
    public string $email;
    public string $password;
    public string $username;
    public ?string $bio;

    public function __construct(
        string $email,
        string $password,
        string $username,
        ?string $bio = null
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->bio = $bio;
    }
}
