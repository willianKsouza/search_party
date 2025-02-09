<?php
namespace App\Interfaces\Users;



use App\DTO\Users\CreateUserDTO;
use PDOException;

interface ICreateUserRepository
{
    public function create(CreateUserDTO $user): string;
}
