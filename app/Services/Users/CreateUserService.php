<?php

namespace App\Services\Users;

use App\DTO\CreateUserDTO;
use App\Interfaces\ICreateUser;
use App\Repository\Users\CreateUserRepository;
use Exception;

class CreateUserService implements ICreateUser
{
    public function __construct(private CreateUserRepository $createUserRepository) {}
    public function create(CreateUserDTO $dto)
    {
        try {
            $hashedPassword = password_hash($dto->password, PASSWORD_DEFAULT);
            $dto->password = $hashedPassword;
            $user = $this->createUserRepository->create($dto);
            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
