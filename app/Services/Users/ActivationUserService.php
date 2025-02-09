<?php

namespace App\Services\Users;

use App\DTO\Users\ActivationUserDTO;
use App\Interfaces\email\IActivationUserRepository;
use App\Interfaces\Users\IFindUserByEmailRepository;
use Exception;

class ActivationUserService
{
    public function __construct(private IActivationUserRepository $activationUserRepository, private IFindUserByEmailRepository $findUserByEmailRepository) {}

    public function execute(ActivationUserDTO $dto)
    {
        try {
            $findById = $this->findUserByEmailRepository->findByEmail($dto->email);
            if ($findById) {
                $dto->id = $findById->user_id;
                $dto->username = $findById->username;
                $activationEmail = $this->activationUserRepository->sendActivationUser($dto);
                return $activationEmail;
            }
            return throw new Exception("usuario nao encontrado", 404);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
