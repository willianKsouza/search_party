<?php

namespace App\Services\Users;

use App\DTO\Users\ActivationUserDTO;
use Exception;
use App\DTO\Users\CreateUserDTO;
use App\Interfaces\email\IActivationUserRepository;
use App\Interfaces\Users\ICreateUserRepository;
use PDOException;

class CreateUserService
{
    public function __construct(private ICreateUserRepository $createUserRepository, private IActivationUserRepository $activationUserRepository) {}
    public function execute(CreateUserDTO $dto)
    {
        try {
            $hashedPassword = password_hash($dto->password, PASSWORD_DEFAULT);
            $dto->password = $hashedPassword;
            $user = $this->createUserRepository->create($dto);
            if ($user) {
                $activationDTO = new ActivationUserDTO();
                $activationDTO->email = $dto->email;
                $activationDTO->id = $user;
                $activationDTO->username = $dto->username;
                $this->activationUserRepository->sendActivationUser($activationDTO);
            }
            return '$user';
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                throw new Exception($e->getMessage(), 409);
            }
            throw new Exception($e->getMessage(),500);
        }
    }
}
