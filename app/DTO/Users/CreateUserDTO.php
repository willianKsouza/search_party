<?php
namespace App\DTO\Users;




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
        ?string $bio
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->bio = $bio;
    }
}
