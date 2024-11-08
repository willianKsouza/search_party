<?php

namespace App\DTO;

class UserDTO
{
    public string $idUser;
    public string $email;
    public string $username;
    public ?string $bio;

    public function __construct(
        string $idUser,
        string $email,
        string $username,
        ?string $bio = null
    ) {
        $this->idUser = $idUser;
        $this->email = $email;
        $this->username = $username;
        $this->bio = $bio;
    }
}
