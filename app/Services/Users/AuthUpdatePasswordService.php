<?php

namespace App\Services\Users;

use App\DTO\Users\AuthUpdateDTO;
use App\Interfaces\Users\Repository\IAuthUpdatePasswordRepository;
use App\Interfaces\Users\Repository\IFindUserByIdRepository;
use Exception;

class AuthUpdatePasswordService
{
    public function __construct(private IAuthUpdatePasswordRepository $authUpdatePasswordRepository, private IFindUserByIdRepository $findUserByIdRepository) {}

    public function execute(AuthUpdateDTO $dto)
    {
        try {
            $user = $this->findUserByIdRepository->findById($dto->idUser);
            if ($user) {
                $hashedPassword = password_hash($dto->password, PASSWORD_DEFAULT);
                $dto->password = $hashedPassword;
                $user = $this->authUpdatePasswordRepository->update($dto);
                return $user;
            }
            return throw new Exception('usuario nao encontrado', 404);
        } catch (Exception $e) {
            return throw new Exception($e->getMessage());
        }
    }
}
